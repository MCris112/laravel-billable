<?php

namespace MCris112\Billable\Contracts;

use MCris112\Billable\Models\Order;
use MCris112\Billable\Models\PaymentProvider;

interface PaymentMethodDriver
{

    /**
     * Set the currency to use when creating the PaymentMethodDriver
     * @param string $currency
     */
    public function __construct(string $currency, PaymentProvider $model);

    /**
     * Return Preference after generate with the payment method driver selected
     * @param Order $order
     * @return mixed
     */
    public function make(Order $order);
}
