<?php

namespace MCris112\Billable\Base;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use MCris112\Billable\Exceptions\Order\OrderNoCustomerSetException;
use MCris112\Billable\Models\Order;
use MCris112\Billable\Models\PaymentMethodProvider;

abstract class AbstractPaymentMethodProvider
{
    protected string $abstractOrderProvider;

    public function __construct(
        protected PaymentMethodProvider $paymentMethodProvider,
        protected ?User $customer = null)
    {

    }

    public function withCustomer(User $customer)
    {
        return new static($this->paymentMethodProvider, $customer);
    }

    public function withCurrency(string $code): static
    {
        $this->paymentMethodProvider->setCurrentCurrency($code);
        return $this;
    }

    public function order(): AbstractOrderProvider
    {
        if(!$this->customer) throw new OrderNoCustomerSetException;
        return new $this->abstractOrderProvider(
            $this->paymentMethodProvider,
            $this->customer
        );
    }

    /**
     * @param Order|string $orderModelOrId
     * @return AbstractOrderProvider
     * @throws OrderNoCustomerSetException
     */
    public function withOrder(Order|string $orderModelOrId): AbstractOrderProvider
    {
        if(!$this->customer) throw new OrderNoCustomerSetException;
        return new $this->abstractOrderProvider(
            $this->paymentMethodProvider,
            $this->customer,
            $orderModelOrId
        );
    }
}
