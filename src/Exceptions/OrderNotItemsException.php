<?php

namespace MCris112\Billable\Exceptions;

class OrderNotItemsException extends \Exception
{

    public function __construct()
    {
        parent::__construct("There's no items to create the order", 422);
    }
}
