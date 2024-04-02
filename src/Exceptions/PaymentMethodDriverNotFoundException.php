<?php

namespace MCris112\Billable\Exceptions;

class PaymentMethodDriverNotFoundException extends \Exception
{

    public function __construct(string $paymentMethod)
    {
        parent::__construct("We can't process the payment with ".$paymentMethod, 404);
    }
}
