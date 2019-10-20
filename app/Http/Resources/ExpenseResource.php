<?php

namespace App\Http\Resources;

use App\Entities\JsonResource;

class ExpenseResource extends JsonResource
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
            'type' => $this->type,
            'createdAt' => $this->created_at->format(static::DATE_FORMAT),
            'updatedAt' => $this->updated_at->format(static::DATE_FORMAT)
        ];
    }
}
