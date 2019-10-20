<?php

namespace App\Http\Resources;

use App\Entities\JsonResource;

class ClientResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'userId' => $this->userId,
            'name' => $this->name,
            'surname' => $this->surname,
            'patronymic' => $this->patronymic,
            'emails' => $this->emails->pluck('email'),
            'phones' => $this->phones->pluck('phone'),
            'comment' => $this->comment,
            'createdAt' => $this->created_at->format(static::DATE_FORMAT),
            'updatedAt' => $this->updated_at->format(static::DATE_FORMAT)
        ];
    }
}
