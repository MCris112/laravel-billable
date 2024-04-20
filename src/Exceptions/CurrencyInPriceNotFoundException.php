<?php

namespace MCris112\Billable\Exceptions;

use Exception;

class CurrencyInPriceNotFoundException extends Exception
{

    public function __construct(string $currencyCode)
    {
        parent::__construct("Currency ".$currencyCode." not available", 404);
    }
}
