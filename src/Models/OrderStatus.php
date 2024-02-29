<?php

namespace MCris112\Billable\Models;

use Illuminate\Database\Eloquent\Model;

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
