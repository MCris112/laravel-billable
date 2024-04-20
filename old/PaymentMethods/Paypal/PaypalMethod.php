<?php

namespace PaymentMethods\Paypal;

use Base\AbstractPaymentMethod;
use Base\AbstractPreference;
use Illuminate\Support\Collection;
use MCris112\Billable\Exceptions\CurrencyInPriceNotFoundException;
use MCris112\Billable\Models\Order;
use MCris112\Billable\Models\OrderItem;
use PaymentMethods\Paypal\Resources\AccessToken;
use PaymentMethods\Paypal\Resources\OrderClient;

class PaypalMethod extends AbstractPaymentMethod
{

    protected static string $CONFIG_NAME = "paypal";
    protected static string $URL_SANDBOX = "https://api-m.sandbox.paypal.com/";

    function make(Order $order): AbstractPreference
    {
        $client = new OrderClient();

        return new PaypalPreference( $client->create(new AccessToken(), $this->parseOrderItems($order->items)) );
    }

    /**
     * @inheritDoc
     * @throws CurrencyInPriceNotFoundException
     */
    function parseOrderItems(Collection $items): array
    {
        $content = [];

        /** @var OrderItem $item **/
        foreach ($items as $item)
        {
            $content[] = [
                "reference_id" => $item->getKey(),
                "amount" => [
                    "currency_code" => $this->currency,
                    "value" => $item->orderable->getPrice($this->currency)->value
                ]
            ];
        }

        return $content;
    }
}
