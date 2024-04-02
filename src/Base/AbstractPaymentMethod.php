<?php

namespace MCris112\Billable\Base;

use Illuminate\Support\Collection;
use MCris112\Billable\Contracts\PaymentMethodDriver;
use MCris112\Billable\Models\Order;
use MCris112\Billable\Models\OrderItem;
use MCris112\Billable\Models\PaymentProvider;

abstract class AbstractPaymentMethod implements  PaymentMethodDriver
{
    protected static string $CONFIG_NAME;

    protected static string $URL_PRODUCTION;

    protected static  string $URL_SANDBOX;

    public static function URL(string $endPoint): string
    {
        if(config("billable.providers.".static::$CONFIG_NAME.".isDevMode", true))
        return static::$URL_SANDBOX.$endPoint;

        return static::$URL_PRODUCTION.$endPoint;
    }

    public function __construct(protected string $currency, protected PaymentProvider $model)
    {

    }

    abstract function make(Order $order): AbstractPreference;

    /**
     * @param Collection<OrderItem> $order
     * @return array
     */
    abstract function parseOrderItems(Collection $items): array;
}
