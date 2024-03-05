<?php

namespace MCris112\Billable\PaymentMethods\Mercadopago;

use MCris112\Billable\Base\AbstractPreference;
use MercadoPago\Resources\Preference;

class MercadoPagoPreference extends AbstractPreference
{

    public function __construct(Preference|array $data)
    {
        if($data instanceof Preference)
        {
            $this->id = $data->id;

            return;
        }

        parent::__construct($data);
    }

    public function toArray(): array
    {
        return [];
    }
}
