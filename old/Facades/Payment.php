<?php

namespace Facades;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;
use MCris112\Billable\BillableService;

/**
 * MCris112\Billable\Facades\Payment
 * @method static \Base\AbstractPaymentMethod use(string $paymentMethod, string $currency)
 * @method static Collection|\MCris112\Billable\Models\PaymentMethodProvider get(?string $paymentMethod = null)
 */
class Payment extends Facade
{

    protected static function getFacadeAccessor(): string
    {
        return BillableService::class;
    }

}
