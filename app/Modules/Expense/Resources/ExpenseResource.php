<?php

namespace App\Modules\Expense\Resources;

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
            'isActive' => $this->is_active,
            'period' => $this->period,
            'startDate' => $this->start_date ? $this->start_date->format(config('app.apiDateFormat')) : null,
            'createdAt' => $this->created_at->format(config('app.apiDateFormat')),
            'updatedAt' => $this->updated_at->format(config('app.apiDateFormat'))
        ];
    }
}
