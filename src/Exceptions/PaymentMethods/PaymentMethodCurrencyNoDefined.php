<?php

namespace MCris112\Billable\Exceptions\PaymentMethods;

class PaymentMethodCurrencyNoDefined extends \Exception
{
    public function __construct()
    {
        parent::__construct("Currency is not defined", 500);
    }
}
