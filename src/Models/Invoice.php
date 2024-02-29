<?php

namespace MCris112\Billable\Models;

use Illuminate\Database\Eloquent\Model;

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
