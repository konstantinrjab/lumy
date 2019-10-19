<?php

namespace App\Http\Resources;

use App\Entities\JsonResource;

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
            'created_at' => $this->created_at->format(static::DATE_FORMAT),
            'updated_at' => $this->updated_at->format(static::DATE_FORMAT)
        ];
    }
}
