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
            'datetime' => $this->dateTime,
            'address' => $this->address,
            'deadline' => $this->deadline,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
