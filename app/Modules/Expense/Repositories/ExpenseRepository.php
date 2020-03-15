<?php

namespace App\Modules\Expense\Repositories;

use App\Modules\Expense\Models\Expense;
use Carbon\Carbon;
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
        $this->prepareData($data);
        $expense = new Expense($data);

        if (!$expense->save()) {
            return null;
        }

        return $expense;
    }

    public function update(int $id, array $data, int $userId): bool
    {
        $this->prepareData($data);

        return Expense::where(['id' => $id, 'user_id' => $userId])->firstOrFail()->update($data);
    }

    public function delete(int $id, int $userId): int
    {
        return Expense::where(['id' => $id, 'user_id' => $userId])->delete();
    }

    private function prepareData(array &$data): void
    {
        $data['start_date'] = $data['start_date']
            ? Carbon::parse($data['start_date'])->format(config('app.mysqlDateFormat'))
            : null;
        $data['is_active'] = $data['is_active'] ?? false;
    }
}
