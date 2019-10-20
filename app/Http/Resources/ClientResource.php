<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'patronymic' => $this->patronymic,
            'emails' => $this->emails->pluck('email'),
            'phones' => $this->phones->pluck('phone'),
            'comment' => $this->comment,
            'createdAt' => $this->created_at->format(config('app.dateFormat')),
            'updatedAt' => $this->updated_at->format(config('app.dateFormat'))
        ];
    }
}
