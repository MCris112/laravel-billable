<?php

namespace MCris112\Billable\Traits;

use MCris112\Billable\Base\AbstractPaymentMethodProvider;
use MCris112\Billable\Facades\LaravelBillable;

trait HasPayment
{

    public function usePaymentMethod(string $name, string $currency): AbstractPaymentMethodProvider
    {
        return LaravelBillable::use($name, $currency, $this );
    }
}
