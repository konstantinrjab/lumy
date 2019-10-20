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
            'createdAt' => $this->created_at->format(config('app.dateFormat')),
            'updatedAt' => $this->updated_at->format(config('app.dateFormat'))
        ];
    }
}
