<?php

namespace App\Modules\User\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'email'     => $this->email,
            'social'    => isset($this->social) ? $this->social->only('google_id') : null,
            'createdAt' => isset($this->created_at) ? $this->created_at->format(config('app.apiDateFormat')) : null,
            'updatedAt' => isset($this->updated_at) ? $this->updated_at->format(config('app.apiDateFormat')) : null
        ];
    }
}
