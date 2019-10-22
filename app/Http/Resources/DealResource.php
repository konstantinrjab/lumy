<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DealResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => [
                'nominal' => $this->price,
                'currency' => $this->currency
            ],
            'prepay' => [
                'nominal' => $this->prepay_price,
                'currency' => $this->prepay_currency
            ],
            'facilities' => DealFacilityResource::collection($this->facilities),
            'datetime' => $this->dateTime,
            'address' => $this->address,
            'deadline' => $this->deadline,
            'createdAt' => $this->created_at->format(config('app.apiDateFormat')),
            'updatedAt' => $this->updated_at->format(config('app.apiDateFormat'))
        ];
    }
}
