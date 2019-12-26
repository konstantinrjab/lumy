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
            'comment'    => $this->comment,
            'start'      => $this->start ? $this->start->format(config('app.apiDateFormat')) : null,
            'end'        => $this->end ? $this->end->format(config('app.apiDateFormat')) : null,
            'deadline'   => $this->deadline ? $this->deadline->format(config('app.apiDateFormat')) : null,
            'googleCalendar'   => [
                'save' => (bool) $this->google_calendar_id,
                'google_calendar_id' => $this->google_calendar_id ?? null,
            ],
            'createdAt'  => $this->created_at->format(config('app.apiDateFormat')),
            'updatedAt'  => $this->updated_at->format(config('app.apiDateFormat'))
        ];
    }
}
