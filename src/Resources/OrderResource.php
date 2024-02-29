<?php

namespace MCris112\Billable\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'user' => $this->getUserColumns(),

            'preference' => [
                'id' => $this->preference_id
            ],

            'items' => $this->items,

            'totals' => [
                'code' => $this->totals_currency_code,
                'discount' => $this->totals_discount,
                'amount' => $this->totals_amount
            ],

            'timestamps' => [
                'createdAt' => $this->created_at,
                'updatedAt' => $this->updated_at
            ]
        ];
    }

    private function getUserColumns(): array
    {
        $config = config('billable.order.user.columns');

        $columns = [];

        foreach ($config as $key => $value) {
            // in case is an object, so it can be used as a key name
            if(!is_numeric($key))
            {
                $columns[$key] = $this->user->$value;
                continue;
            }

            $columns[$value] = $this ->user->$value;
        }

        return $columns;
    }
}
