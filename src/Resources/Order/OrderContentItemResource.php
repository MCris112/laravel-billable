<?php

namespace MCris112\Billable\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderContentItemResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        $prices = [];

        foreach ($this->orderable->prices as $price) {
            $prices[$price->currency_code] = [
                "value" => $price->value,
                $this->mergeWhen( $price->discount_start || $price->discount_end, [
                    "discount" => [
                        "start" => $price->discount_start,
                        "end" => $price->discount_end
                    ]
                ])
            ];
        }

        return [
            "id" => $this->id,
            "quantity" => $this->quantity,
            'type' => $this->orderable->getOrderItemTypeName(),
            "data" => $this->orderable->toResource(),
            "prices" => $prices
        ];
    }
}
