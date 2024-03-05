<?php

namespace MCris112\Billable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use MCris112\Billable\Traits\Priceable;

/**
 * MCris112\Billable\Models\OrderItem
 *
 * @property int $id
 * @property string $order_id
 * @property string $orderable_type
 * @property string $orderable_id
 * @property int $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent|Priceable $orderable
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereOrderableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereOrderableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderItem extends Model
{
    protected $fillable = [
        'orderable_type',
        'orderable_id',
        'quantity',
    ];
    public function getTable(): string
    {
        return config('billable.table.prefix').'order_items';
    }

    public function orderable(): MorphTo
    {
        return $this->morphTo("orderable");
    }
}
