<?php

namespace MCris112\Billable\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * MCris112\Billable\Models\Invoice
 *
 * @property int $id
 * @property string $invoiceable_type
 * @property string $invoiceable_id
 * @property int $invoiceable_quantity
 * @property string $payment_provider_id
 * @property int $customer_id
 * @property int $taxpayer_id
 * @property int $sales_rep_id
 * @property string|null $comment
 * @property string $currency_code
 * @property float $subtotal
 * @property float $tax_rate
 * @property float $tax_value
 * @property float $totals
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereCurrencyCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereInvoiceableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereInvoiceableQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereInvoiceableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice wherePaymentProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereSalesRepId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereSubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereTaxRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereTaxValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereTaxpayerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereTotals($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Invoice extends Model
{
    protected $fillable = [
        'invoiceable_type',
        'invoiceable_id',
        'invoiceable_quantity',
        'payment_provider_id',
        'customer_id',
        'taxpayer_id',
        'sales_rep_id',
        'comment',
        'currency_code',
        'subtotal',
        'tax_rate',
        'tax_value',
        'totals',
    ];

    public function getTable(): string
    {
        return config('billable.table.prefix').'invoices';
    }
}
