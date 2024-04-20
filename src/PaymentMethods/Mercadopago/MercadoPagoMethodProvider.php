<?php

namespace MCris112\Billable\PaymentMethods\Mercadopago;

use MCris112\Billable\Base\AbstractOrderProvider;
use MCris112\Billable\Base\AbstractPaymentMethodProvider;
use MCris112\Billable\Exceptions\Order\OrderNoCustomerSetException;
use MCris112\Billable\Models\Order;

class MercadoPagoMethodProvider extends AbstractPaymentMethodProvider
{

    protected string $abstractOrderProvider = MercadopagoOrderPrivder::class;
}
