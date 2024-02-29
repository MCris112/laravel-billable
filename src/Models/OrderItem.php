<?php

namespace MCris112\Billable\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'orderable_type',
        'orderable_id',
        'quantity',
        'price'
    ];
    public function getTable(): string
    {
        return config('billable.table.prefix').'order_items';
    }
}
