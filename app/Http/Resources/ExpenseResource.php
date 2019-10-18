<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
