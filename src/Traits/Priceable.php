<?php

namespace MCris112\Billable\Traits;

use Illuminate\Http\Resources\Json\JsonResource;
use MCris112\Billable\Exceptions\CurrencyInPriceNotFoundException;
use MCris112\Billable\Models\Price;
use Resources\PriceResource;

trait Priceable
{
    /**
     * Get the price for specific currency code
     * @param string $currencyCode Currency code, example "PEN"
     * @return float
     *
     * @throws CurrencyInPriceNotFoundException
     */
    public function getPrice(string $currencyCode): Price
    {
        foreach ($this->prices as $price) {
            if($price->currency_code == $currencyCode)
                return $price;
        }

        throw new CurrencyInPriceNotFoundException($currencyCode);
    }

    public function addPrice($currencyCode, $value, ?string $discountStart = null, ?string $discountEnd = null): void
    {
        $this->prices()->create([
            "currency_code" => $currencyCode,
            "value" => $value,
            "discount_start" => $discountStart,
            "discount_end" => $discountEnd
        ]);
    }

    public function prices()
    {
        return $this->morphMany(Price::class, "priceable");
    }

    public function pricesToResource(): array
    {
        return PriceResource::parse($this->prices);
    }

    /**
     * Transform into a resource
     * Remember to delete the "prices" relation in the resource
     * @return JsonResource
     */
    abstract function toResource(): JsonResource;

    /**
     * This is used to identify what type of OrderItemResource is on the frontend
     * @return string
     */
    abstract function getOrderItemTypeName(): string;

    abstract function getOrderItemName(): string;

    abstract function getOrderItemDescription(): string;

    abstract function getOrderItemPictureUrl(): string;

}
