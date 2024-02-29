<?php

namespace MCris112\Billable\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use MCris112\Billable\Exceptions\OrderNotFoundException;
use MCris112\Billable\Resources\OrderResource;

class Order extends Model
{

    use HasUuids;
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

    /**
     * Return the Order cached forever
     * @param string $id
     * @return self
     * @throws OrderNotFoundException
     */
    public static function get(string $id): self
    {
        $order = Cache::rememberForever('order_'.$id, fn() => static::with('items', 'user:'.implode(',', config('billable.order.user.columns', ['id'])))->whereId($id)->first() );

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
     * @return self
     */
    public static function create(User $user): self
    {
        $model = new self([
            'user_id' => $user->id,
//            'payment_provider_id' => 'mercadopago'
            'totals_currency_code' => 'PEN',
            'totals_amount' => 10.0
        ]);

        $model->save();

        return $model;
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
