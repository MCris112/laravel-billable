<?php

namespace PaymentMethods\Paypal\Resources;

use Illuminate\Support\Facades\Http;
use PaymentMethods\Paypal\PaypalMethod;

class OrderClient
{

    public function create(AccessToken $accessToken, array $items): array
    {
        $request = Http::withHeader("Authorization", $accessToken->getAuthorizationHeader())
            ->post( PaypalMethod::URL("v2/checkout/orders"), [
                "intent" => "CAPTURE",
                "purchase_units" => $items,
                "payment_source" => [
                    "paypal" => [
                        "experience_context" => [
                            "return_url" => "http://127.0.0.1:8000/test",
                            "cancel_url" => "http://127.0.0.1:8000/test"
                        ]
                    ]
                ]
            ]);

        return $request->json();
    }
}
