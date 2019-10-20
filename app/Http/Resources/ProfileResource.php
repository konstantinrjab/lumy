<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'createdAt' => $this->created_at->format(config('app.dateFormat')),
            'updatedAt' => $this->updated_at->format(config('app.dateFormat'))
        ];
    }
}
