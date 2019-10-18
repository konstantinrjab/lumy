<?php

namespace App\Database\Repositories;

use App\Database\Models\Facility;
use Illuminate\Database\Eloquent\Collection;

class FacilityRepository
{
    public function get(int $id): ?Facility
    {
        return Facility::find($id);
    }

    public function all(): Collection
    {
        return Facility::all();
    }

    public function getByUserId(int $userId): Collection
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

    public function update(int $clientId, array $data)
    {
        Facility::find($clientId)->update($data);
    }

    public function delete(int $id): int
    {
        return Facility::destroy($id);
    }
}
