<?php

namespace App\Database\Repositories;

use App\Database\Models\Expense;
use Illuminate\Database\Eloquent\Collection;

class ExpenseRepository
{
    public function get(int $id): ?Expense
    {
        return Expense::find($id);
    }

    public function all(): Collection
    {
        return Expense::all();
    }

    public function getByUserId(int $userId): Collection
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

    public function update(int $clientId, array $data): bool
    {
        return Expense::findOrFail($clientId)->update($data);
    }

    public function delete(int $id): int
    {
        return Expense::destroy($id);
    }
}
