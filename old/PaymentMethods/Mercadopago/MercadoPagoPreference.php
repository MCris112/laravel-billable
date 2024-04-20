<?php

namespace PaymentMethods\Mercadopago;

use Base\AbstractPreference;
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
