<?php

namespace MCris112\Billable;

use App\Models\User;
use Cache;
use Illuminate\Support\Collection;
use MCris112\Billable\Base\AbstractPaymentMethodProvider;
use MCris112\Billable\Exceptions\PaymentMethodDriverNotFoundException;
use MCris112\Billable\Models\PaymentMethodProvider;
use MCris112\Billable\PaymentMethods\Mercadopago\MercadoPagoMethodProvider;

class BillableService
{
    const CACHE_GET_ALL = "payment_methods";
    private array $methods = [
        "mercadopago" => MercadoPagoMethodProvider::class,
//        "paypal" => PaypalMethod::class
        ];

    /**
     * Create the driver to perform the payment process
     * @param string $paymentMethod
     * @param user|null $customer
     * @return AbstractPaymentMethodProvider
     * @throws PaymentMethodDriverNotFoundException
     */
    public function use(string $paymentMethod, ?User $customer = null): AbstractPaymentMethodProvider
    {
        if(key_exists($paymentMethod, $this->methods))
            return new $this->methods[$paymentMethod]($this->get($paymentMethod), $customer);

        throw new PaymentMethodDriverNotFoundException($paymentMethod);
    }

    /**
     * Get all the payment methods in db or by id
     * @param string|null $paymentMethod
     * @return Collection|PaymentMethodProvider
     * @throws PaymentMethodDriverNotFoundException
     */
    public function get(?string $paymentMethod = null):  Collection|PaymentMethodProvider
    {
        $paymentMethods = Cache::rememberForever(self::CACHE_GET_ALL, fn() => PaymentMethodProvider::all() );

        if($paymentMethod) //TODO if is active
            return $paymentMethods->filter( fn($method) => $method->id == $paymentMethod)->first() ?? throw new PaymentMethodDriverNotFoundException($paymentMethod);

        return $paymentMethods;
    }
}
