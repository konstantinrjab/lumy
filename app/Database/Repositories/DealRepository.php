<?php

namespace App\Database\Repositories;

use App\Database\Models\Deal;
use Illuminate\Database\Eloquent\Collection;

class DealRepository
{
    public function get(int $id): ?Deal
    {
        return Deal::find($id);
    }

    public function all(): Collection
    {
        return Deal::all();
    }

    public function getByUserId(int $userId): Collection
    {
        return Deal::where('user_id', $userId)->get();
    }

    public function create(array $data): ?Deal
    {
        $deal = new Deal($data);

        if (!$deal->save()) {
            return null;
        }

        return $deal;
    }

    public function delete(int $id): int
    {
        return Deal::destroy($id);
    }

    public function update(int $id, array $data): bool
    {
        return Deal::findOrFail($id)->update($data);
    }
}
