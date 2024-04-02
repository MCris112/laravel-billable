<?php

namespace MCris112\Billable\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use MCris112\Billable\Exceptions\OrderCreateException;
use MCris112\Billable\Exceptions\OrderNotFoundException;
use MCris112\Billable\Exceptions\OrderNotItemsException;
use MCris112\Billable\Observers\OrderObserver;
use MCris112\Billable\Resources\Order\OrderResource;
use MCris112\Billable\Traits\Invoiceable;
use Throwable;

#[ObservedBy([OrderObserver::class])]
/**
 * MCris112\Billable\Models\Order
 *
 * @property string $id
 * @property int $user_id
 * @property string|null $preference_id
 * @property string|null $preference_content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \MCris112\Billable\Models\OrderItem> $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \MCris112\Billable\Models\OrderStatus> $statuses
 * @property-read int|null $statuses_count
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePreferenceContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePreferenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 * @mixin \Eloquent
 */
class Order extends Model
{

    use HasUuids, Invoiceable;
    protected $fillable = [
        'user_id',
        'totals_currency_code',
        'totals_amount'
    ];

    protected $keyType = 'string';

    public function getTable(): string
    {
        return config('billable.table.prefix').'orders';
    }

    public static function getUserColumnsAsText()
    {
        return 'user:'.implode(',', config('billable.order.user.columns', ['id']));
    }
    /**
     * Return the Order cached forever
     * @param string $id
     * @return self
     * @throws OrderNotFoundException
     */
    public static function get(string $id): self
    {
        $order = Cache::rememberForever('order_'.$id, fn() => static::with(
            'items',
            'items.orderable',
            'items.orderable.prices',
            static::getUserColumnsAsText()
        )->whereId($id)->first() );

        if(!$order) throw new OrderNotFoundException();

        return $order;
    }

    public function toResource()
    {
        return new OrderResource($this);
    }

    /**
     * Create a new order
     *
     * @param User $user User that will have this order
     * @param array<OrderItem> $items Order items, Create it with Order::Item(...)
     * @return self
     *
     * @throws OrderCreateException|Throwable
     */
    public static function create(User $user, array $items = []): self
    {
        if(count($items) == 0) throw new OrderNotItemsException();

        $model = new self([
            'user_id' => $user->id,
        ]);

        try{
            $model->saveOrFail();
        } catch (\Exception $e) {
            throw new OrderCreateException();
        }

        $model->user = $user; //to avoid get the same user twice. instead of using $model->load('user')
        $model->items()->saveMany($items);

        $model->load('items.orderable', 'items.orderable.prices' );

        return $model;
    }


    public static function Item(Model $model, int $quantity)
    {
        $item = new OrderItem([
            'orderable_type' => $model->getMorphClass(),
            'orderable_id' => $model->getKey(),
            'quantity' => $quantity
        ]);

        return $item;
    }

    public function addItem(Model $item, int $quantity, float $price)
    {
        $this->items()->create([
            'orderable_type' => $item->getMorphClass(),
            'orderable_id' => $item->id,
            'quantity' => $quantity,
            'price' => $price
        ]);
    }

    /*-------------------------
    -
    -  RELATIONS
    -
    -------------------------*/


    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function statuses()
    {
        return $this->hasMany(OrderStatus::class);
    }
}
