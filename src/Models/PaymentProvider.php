<?php

namespace MCris112\Billable\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * MCris112\Billable\Models\PaymentProvider
 *
 * @property int $id
 * @property string $name
 * @property string $tax_type
 * @property float $tax_amount
 * @property string|null $options
 * @property int $active
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentProvider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentProvider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentProvider query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentProvider whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentProvider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentProvider whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentProvider whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentProvider whereTaxAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentProvider whereTaxType($value)
 * @property string $currency_support
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentProvider whereCurrencySupport($value)
 * @mixin \Eloquent
 */
class PaymentProvider extends Model
{
    protected $keyType = "string";
    public $incrementing = false;
    public $timestamps = false;

    public function getTable(): string
    {
        return config('billable.table.prefix').'payment_providers';
    }
}
