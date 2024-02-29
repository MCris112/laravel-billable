<?php

namespace MCris112\Billable\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentProvider extends Model
{
    public function getTable(): string
    {
        return config('billable.table.prefix').'payment_providers';
    }
}
