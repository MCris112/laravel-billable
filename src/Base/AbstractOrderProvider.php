<?php

namespace MCris112\Billable\Base;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use MCris112\Billable\Exceptions\OrderCreateException;
use MCris112\Billable\Exceptions\OrderNotFoundException;
use MCris112\Billable\Exceptions\OrderNotItemsException;
use MCris112\Billable\Exceptions\PaymentMethods\PaymentMethodCurrencyNoDefined;
use MCris112\Billable\Models\Order;
use MCris112\Billable\Models\OrderItem;
use MCris112\Billable\Models\PaymentMethodProvider;

abstract class AbstractOrderProvider
{

    protected ?Order $order;

    /**
     * @throws OrderNotFoundException
     */
    public function __construct(
        protected PaymentMethodProvider $paymentMethod,
        protected User $customer,
        Order|string|null $order = null)
    {

        if(!$order) return;

        if($order instanceof Order)
        {
            $this->order = $order;
            return;
        }

        $this->order = static::find($order);
    }


    protected function newStatic(): static
    {
        return new static(
            $this->paymentMethod,
            $this->customer,
            $this->order);
    }

    /**
     * Return the Order cached forever
     * @param string $id
     * @return Order
     * @throws OrderNotFoundException
     */
    public static function find(string $id): Order
    {
        $order = Cache::rememberForever('order_'.$id, fn() => Order::with(
            'items',
            'items.orderable',
            'items.orderable.prices',
            Order::getUserColumnsAsText() //TODO FIX
        )->whereId($id)->first() );

        if(!$order) throw new OrderNotFoundException();

        return $order;
    }

    /**
     * @param ?int $id You can set it to get a specific Order instance, otherwise return the default
     * @throws OrderNotFoundException
     */
    public function get(?int $id = null): Order
    {
        if($id) return static::find($id);

        return $this->order;
    }
    abstract public function pay();


    /**
     * Create a new order
     *
     * @param array<OrderItem> $items Order items, Create it with OrderItem::base(...)
     * @return static
     * @throws OrderCreateException
     * @throws PaymentMethodCurrencyNoDefined
     */
    public function create( array $items = [] ): static
    {
        if(count($items) == 0) throw new OrderNotItemsException();

        $this->order = new Order([
            'user_id' => $this->customer->id,
            "payment_method_provider_id" => $this->paymentMethod->id,
            'totals_currency_code' => $this->paymentMethod->getCurrentCurrency(),
            "totals_amount" => count($items)
        ]);

        try{
            $this->order->saveOrFail();
        } catch (\Exception $e) {
            throw new OrderCreateException();
        }

//        $model->user = $this->customer; //to avoid get the same user twice. instead of using $model->load('user')
        $this->addItems($items);

//        $model->load('items.orderable', 'items.orderable.prices' );

        $this->order = static::find( $this->order->id );
        return $this->newStatic();
    }

    public function addItem( OrderItem $orderItem): static
    {
        $this->order->items()->save($orderItem);

        return $this->newStatic();
    }

    /**
     * @param array<OrderItem> $orderItems
     * @return static
     */
    public function addItems( array $orderItems)
    {
        foreach ($orderItems as $orderItem)
            $this->addItem($orderItem);

        return $this->newStatic();
    }

}
