<?php

namespace MCris112\Billable\Facades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;
use MCris112\Billable\Base\AbstractPaymentMethodProvider;
use MCris112\Billable\BillableService;
use MCris112\Billable\Manager\OrderManager;

/**
 * @method static AbstractPaymentMethodProvider use(string $paymentMethod, string $currency = null, ?Model $customer = null)
 * @method static OrderManager order();
 */
class LaravelBillable extends Facade
{

    protected static function getFacadeAccessor()
    {
        return BillableService::class;
    }
}
