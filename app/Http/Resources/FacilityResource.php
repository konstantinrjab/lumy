<?php

namespace App\Http\Resources;

use App\Entities\JsonResource;

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
            'created_at' => $this->created_at->format(static::DATE_FORMAT),
            'updated_at' => $this->updated_at->format(static::DATE_FORMAT)
        ];
    }
}
