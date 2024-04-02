<?php

namespace MCris112\Billable;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use MCris112\Billable\Base\AbstractPaymentMethod;
use MCris112\Billable\Exceptions\PaymentMethodDriverNotFoundException;
use MCris112\Billable\Models\PaymentProvider;
use MCris112\Billable\PaymentMethods\Mercadopago\MercadopagoMethod;
use MCris112\Billable\PaymentMethods\Paypal\PaypalMethod;

class PaymentManager
{
    const CACHE_GET_ALL = "payment_methods";
    private array $methods = [
        "mercadopago" => MercadopagoMethod::class,
        "paypal" => PaypalMethod::class
        ];

    /**
     * Create the driver to perform the payment process
     * @param string $paymentMethod
     * @param string $currency
     * @return AbstractPaymentMethod
     * @throws PaymentMethodDriverNotFoundException
     */
    public function use(string $paymentMethod, string $currency): AbstractPaymentMethod
    {
        if(key_exists($paymentMethod, $this->methods))
            return new $this->methods[$paymentMethod]($currency, $this->get($paymentMethod));

        throw new PaymentMethodDriverNotFoundException($paymentMethod);
    }

    /**
     * Get all the payment methods in db or by id
     * @param string|null $paymentMethod
     * @return Collection|PaymentProvider
     * @throws PaymentMethodDriverNotFoundException
     */
    public function get(?string $paymentMethod = null):  Collection|PaymentProvider
    {
        $paymentMethods = Cache::rememberForever(self::CACHE_GET_ALL, fn() => PaymentProvider::all() );

        if($paymentMethod)
            return $paymentMethods->filter( fn($method) => $method->id == $paymentMethod)->first() ?? throw new PaymentMethodDriverNotFoundException($paymentMethod);

        return $paymentMethods;
    }
}
