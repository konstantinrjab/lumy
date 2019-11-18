<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'email'     => $this->email,
            'createdAt' => $this->created_at->format(config('app.apiDateFormat')),
            'updatedAt' => $this->updated_at->format(config('app.apiDateFormat'))
        ];
    }
}
