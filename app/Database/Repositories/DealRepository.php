<?php

namespace App\Database\Repositories;

use App\Database\Models\Deal;
use Illuminate\Database\Eloquent\Collection;

class DealRepository
{
    public function getByIdAndUserId(int $id, int $userId): ?Deal
    {
        return Deal::where(['id' => $id, 'user_id' => $userId])->first();
    }

    public function getAllByUserId(int $userId): Collection
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

    public function update(int $id, array $data, int $userId): bool
    {
        return Deal::where(['id' => $id, 'user_id' => $userId])->firstOrFail()->update($data);
    }

    public function delete(int $id, int $userId): int
    {
        return Deal::where(['id' => $id, 'user_id' => $userId])->delete();
    }
}
