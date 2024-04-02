<?php

namespace MCris112\Billable\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * MCris112\Billable\Models\OrderStatus
 *
 * @property int $id
 * @property string $order_id
 * @property string $value
 * @property string|null $description
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OrderStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderStatus whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderStatus whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderStatus whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderStatus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderStatus whereValue($value)
 * @mixin \Eloquent
 */
class OrderStatus extends Model
{
    protected $fillable = [
        'value',
        'description',
        'created_by',
    ];
    public function getTable(): string
    {
        return config('billable.table.prefix').'order_status';
    }
}
