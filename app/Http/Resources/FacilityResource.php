<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FacilityResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'price'         => [
                'nominal'  => $this->price,
                'currency' => $this->currency
            ],
            'expenses'      => FacilityExpenseResource::collection($this->expenses),
            'workingTime'   => $this->working_time,
            'transportTime' => $this->transport_time,
            'deadlineTime'  => $this->deadline_time,
            'isActive'      => (bool)$this->is_active,
            'createdAt'     => $this->created_at->format(config('app.apiDateFormat')),
            'updatedAt'     => $this->updated_at->format(config('app.apiDateFormat'))
        ];
    }
}
