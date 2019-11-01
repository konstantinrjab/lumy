<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DealResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'status'     => $this->status,
            'title'      => $this->title,
            'clientId'   => $this->client_id,
            'price'      => [
                'nominal'  => $this->price,
                'currency' => $this->currency
            ],
            'prepay'     => [
                'nominal'  => $this->prepay_price,
                'currency' => $this->prepay_currency
            ],
            'facilities' => DealFacilityResource::collection($this->facilities),
            'address'    => $this->address,
            'start'      => $this->start->format(config('app.apiDateFormat')),
            'end'        => $this->end->format(config('app.apiDateFormat')),
            'deadline'   => $this->deadline->format(config('app.apiDateFormat')),
            'createdAt'  => $this->created_at->format(config('app.apiDateFormat')),
            'updatedAt'  => $this->updated_at->format(config('app.apiDateFormat'))
        ];
    }
}
