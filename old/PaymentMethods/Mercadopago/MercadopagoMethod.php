<?php

namespace PaymentMethods\Mercadopago;

use Base\AbstractPaymentMethod;
use Base\AbstractPreference;
use Illuminate\Support\Collection;
use MCris112\Billable\Exceptions\CurrencyInPriceNotFoundException;
use MCris112\Billable\Models\Order;
use MCris112\Billable\Models\OrderItem;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

class MercadopagoMethod extends AbstractPaymentMethod
{

    function make(Order $order): AbstractPreference
    {
        MercadoPagoConfig::setAccessToken(config('billable.providers.mercadopago.token'));

        MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

        $request = [
            "items" => $this->parseOrderItems($order->items),
            "payer" => [
                "name" => $order->user->name,
                "surname" => $order->user->lastname,
                "email" => $order->user->email,
            ],
            "back_urls" => [
                'success' => "http://127.0.0.1:8000/test",
                'failure' => "http://127.0.0.1:8000/test"
            ],
//            "statement_descriptor" => "NAME_DISPLAYED_IN_USER_BILLING",
//            "external_reference" => "1234567890",
//            "expires" => false,
            "auto_return" => 'approved',
        ];

        $client = new PreferenceClient();

        try {
            return new MercadoPagoPreference( $client->create($request) );
        } catch (MPApiException $e) {
            echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
            echo "Content: ";
            dump($e->getApiResponse()->getContent());
            echo "\n";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @throws CurrencyInPriceNotFoundException
     */
    function parseOrderItems(Collection $items): array
    {
        $content = [];

        /** @var OrderItem $item **/
        foreach ($items as $item)
        {
            $content[] = [
                "id" => $item->orderable->getKey(),
                "title" => $item->orderable->getOrderItemName(),
                "description" => $item->orderable->getOrderItemDescription(),
                "currency_id" => $this->currency,
                "quantity" => $item->quantity,
                "unit_price" => $item->orderable->getPrice($this->currency)->value,
                "picture_url" => $item->orderable->getOrderItemPictureUrl()
            ];
        }

        return $content;
    }
}
