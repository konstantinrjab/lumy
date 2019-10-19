<?php

namespace App\Http\Resources;

use App\Entities\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'price' => [
                'nominal' => $this->salary,
                'currency' => $this->currency
            ],
            'workHoursInMonth' => $this->work_hours_in_month,
            'created_at' => $this->created_at->format(static::DATE_FORMAT),
            'updated_at' => $this->updated_at->format(static::DATE_FORMAT)
        ];
    }
}
