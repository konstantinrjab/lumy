<?php

namespace App\Database\Repositories;

use App\Database\Models\Facility;
use Illuminate\Database\Eloquent\Collection;

class FacilityRepository
{
    public function getByIdAndUserIdOrFail(int $id, int $userId): Facility
    {
        return Facility::where(['id' => $id, 'user_id' => $userId])->firstOrFail();
    }

    public function getAllByUserId(int $userId): Collection
    {
        return Facility::where('user_id', $userId)->get();
    }

    public function create(array $data): ?Facility
    {
        $facility = new Facility($data);

        if (!$facility->save()) {
            return null;
        }

        return $facility;
    }

    public function update(int $id, array $data, int $userId): bool
    {
        return Facility::where(['id' => $id, 'user_id' => $userId])->firstOrFail()->update($data);
    }

    public function delete(int $id, int $userId): int
    {
        return Facility::where(['id' => $id, 'user_id' => $userId])->delete();
    }
}
