<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DealResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'title' => $this->title,
            'price' => [
                'nominal' => $this->nominal,
                'currency' => $this->currency
            ],
            'datetime' => $this->datetime,
            'address' => $this->address,
            'deadline' => $this->deadline
        ];
    }
}
