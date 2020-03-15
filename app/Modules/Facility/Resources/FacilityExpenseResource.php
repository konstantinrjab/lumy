<?php

namespace App\Modules\Facility\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FacilityExpenseResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'title'  => $this->title,
            'price'  => [
                'nominal'  => $this->price,
                'currency' => $this->currency
            ],
            'number' => $this->number,
        ];
    }
}
