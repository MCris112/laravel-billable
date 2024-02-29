<?php

namespace MCris112\Billable\Exceptions;

use Exception;
use Illuminate\Http\Request;

class OrderNotFoundException extends Exception
{

    public function __construct(string $message = "Sorry, the order that you are looking for is not found", int $code = 404, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
