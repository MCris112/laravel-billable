<?php

namespace MCris112\Billable\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * MCris112\Billable\Models\Price
 *
 * @property int $id
 * @property string $priceable_type
 * @property string $priceable_id
 * @property string $currency_code
 * @property float $value
 * @property string|null $discount_start
 * @property string|null $discount_end
 * @method static \Illuminate\Database\Eloquent\Builder|Price newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Price newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Price query()
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereCurrencyCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereDiscountEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereDiscountStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price wherePriceableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price wherePriceableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereValue($value)
 * @mixin \Eloquent
 */
class Price extends Model
{

    protected $fillable = [
        "currency_code",
        "value",
        "discount_start",
        "discount_end"
    ];

    public $timestamps = false;

    public function getTable(): string
    {
        return config('billable.table.prefix').'model_prices';
    }
}
