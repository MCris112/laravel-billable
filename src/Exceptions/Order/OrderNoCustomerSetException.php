<?php

namespace MCris112\Billable\Exceptions\Order;

class OrderNoCustomerSetException extends \Exception
{
public function __construct()
{
    parent::__construct("No customer for the current order", 500);
}
}
