<?php

namespace App\Modules\Faq\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FaqResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'alias' => $this->alias,
            'title' => $this->title,
            'text' => $this->text,
            'createdAt' => $this->created_at->format(config('app.apiDateFormat')),
            'updatedAt' => $this->updated_at->format(config('app.apiDateFormat'))
        ];
    }
}
