<?php

namespace App\Modules\Deal\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DealFacilityResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'     => $this->id,
            'number' => $this->number,
        ];
    }
}
