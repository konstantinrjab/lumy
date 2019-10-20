<?php

namespace App\Database\Repositories;

use App\Database\Models\Expense;
use Illuminate\Database\Eloquent\Collection;

class ExpenseRepository
{
    public function getByIdAndUserIdOrFail(int $id, int $userId): Expense
    {
        return Expense::where(['id' => $id, 'user_id' => $userId])->firstOrFail();
    }

    public function getAllByUserId(int $userId): Collection
    {
        return Expense::where('user_id', $userId)->get();
    }

    public function create(array $data): ?Expense
    {
        $facility = new Expense($data);

        if (!$facility->save()) {
            return null;
        }

        return $facility;
    }

    public function update(int $id, array $data, int $userId): bool
    {
        return Expense::where(['id' => $id, 'user_id' => $userId])->firstOrFail()->update($data);
    }

    public function delete(int $id, int $userId): int
    {
        return Expense::where(['id' => $id, 'user_id' => $userId])->delete();
    }
}
