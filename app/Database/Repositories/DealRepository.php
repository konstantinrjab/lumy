<?php

namespace App\Database\Repositories;

use App\Database\Models\Deal;
use Illuminate\Database\Eloquent\Collection;

class DealRepository
{
    public function get(int $dealId): ?Deal
    {
        return Deal::find($dealId);
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

    public function delete(int $dealId): int
    {
        return Deal::destroy($dealId);
    }

    public function update(int $dealId, array $data)
    {
        Deal::find($dealId)->update($data);
    }
}
