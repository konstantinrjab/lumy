<?php

namespace App\Http\Resources;

use App\Entities\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'desiredIncome' => [
                'nominal' => $this->desired_income_nominal,
                'currency' => $this->desired_income_currency
            ],
            'language' => $this->language,
            'workHoursInMonth' => $this->work_hours_in_month,
            'createdAt' => $this->created_at->format(static::DATE_FORMAT),
            'updatedAt' => $this->updated_at->format(static::DATE_FORMAT)
        ];
    }
}
