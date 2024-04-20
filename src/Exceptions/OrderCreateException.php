<?php

namespace MCris112\Billable\Exceptions;

use Exception;
use Throwable;

class OrderCreateException extends Exception
{

    public function __construct(string $message = "Something happened while creating the order", int $code = 500, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
