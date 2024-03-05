<?php

namespace MCris112\Billable\Exceptions\Providers\Paypal;

use Exception;

class PaypalAccessTokenException extends Exception
{

    public function __construct()
    {
        parent::__construct("Sorry, we have some problems with Paypal", 500);
    }
}
