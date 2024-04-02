<?php

namespace MCris112\Billable\Facades;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;
use MCris112\Billable\PaymentManager;

/**
 * MCris112\Billable\Facades\Payment
 * @method static \MCris112\Billable\Base\AbstractPaymentMethod use(string $paymentMethod, string $currency)
 * @method static Collection|\MCris112\Billable\Models\PaymentProvider get(?string $paymentMethod = null)
 */
class Payment extends Facade
{

    protected static function getFacadeAccessor(): string
    {
        return PaymentManager::class;
    }

}
