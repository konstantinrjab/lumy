<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FacilityResource extends JsonResource
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
//            'expenses' => $this->expenses(),
            'workingTime' => $this->working_time,
            'transportTime' => $this->transport_time,
            'deadlineTime' => $this->deadline_time,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
