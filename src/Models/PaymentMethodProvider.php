<?php

namespace MCris112\Billable\Models;

use Illuminate\Database\Eloquent\Model;
use MCris112\Billable\Exceptions\PaymentMethods\PaymentMethodCurrencyNoDefined;

/**
 * MCris112\Billable\Models\PaymentMethodProvider
 *
 * @property string $id
 * @property string $name
 * @property string $tax_type
 * @property float $tax_amount
 * @property string $currency_support
 * @property string|null $options
 * @property int $active
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethodProvider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethodProvider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethodProvider query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethodProvider whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethodProvider whereCurrencySupport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethodProvider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethodProvider whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethodProvider whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethodProvider whereTaxAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethodProvider whereTaxType($value)
 * @mixin \Eloquent
 */
class PaymentMethodProvider extends Model
{
    private ?string $currentCurrency;


    protected $keyType = "string";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [];

    public function getTable(): string
    {
        return config('billable.table.prefix').'payment_method_providers';
    }

    /**
     * @return string
     * @throws PaymentMethodCurrencyNoDefined
     */
    public function getCurrentCurrency(): string
    {
        if(!isset($this->currentCurrency)) throw new PaymentMethodCurrencyNoDefined;
        return $this->currentCurrency;
    }

    /**
     * @param string $code
     * @return PaymentMethodProvider
     */
    public function setCurrentCurrency(string $code): self
    {
        $this->currentCurrency = $code;
        return $this;
    }
}
