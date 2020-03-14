<?php

namespace App\Modules\User\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'               => $this->id,
            'desiredIncome'    => [
                'nominal'  => $this->desired_income_nominal,
                'currency' => $this->desired_income_currency
            ],
            'workHoursInMonth' => $this->work_hours_in_month,
            'language'         => $this->language,
            'theme'            => $this->theme,
            'createdAt'        => $this->created_at->format(config('app.apiDateFormat')),
            'updatedAt'        => $this->updated_at->format(config('app.apiDateFormat'))
        ];
    }
}
