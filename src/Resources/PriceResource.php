<?php

namespace MCris112\Billable\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use MCris112\Billable\Models\Price;

class PriceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'value' => $this->value,
            $this->mergeWhen( $this->discount, [
                'discount' => [
                    'value' => $this->discount,
                    'startAt' => $this->discount_start_at,
                    'endAt' => $this->discount_end_at
                ]
            ])
        ];
    }

    public static function parse(Collection $prices): array
    {
        $data = [];

        /** @var Price $price */
        foreach ($prices as $price)
        {
            $data[$price->currency_code] = new self($price);
        }

        return $data;
    }
}
