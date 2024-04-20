<?php

namespace Contracts;

use MCris112\Billable\Models\Order;
use MCris112\Billable\Models\PaymentMethodProvider;

interface PaymentMethodDriver
{

    /**
     * Set the currency to use when creating the PaymentMethodDriver
     * @param string $currency
     */
    public function __construct(string $currency, PaymentMethodProvider $model);

    /**
     * Return Preference after generate with the payment method driver selected
     * @param Order $order
     * @return mixed
     */
    public function make(Order $order);
}
