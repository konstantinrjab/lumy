<?php

namespace App\Modules\Facility\Repositories;

use App\Modules\Facility\Models\Facility;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Exception;

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
        $this->saveRelations($facility, $data);

        return $facility;
    }

    public function update(int $id, array $data, int $userId): bool
    {
        $facility = $this->getByIdAndUserIdOrFail($id, $userId);

        DB::beginTransaction();

        try {
            if (!$facility->update($data)) {
                throw new Exception();
            }

            $facility->expenses()->delete();
            $this->saveRelations($facility, $data);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception('Update fails');
        }

        return true;
    }

    public function delete(int $id, int $userId): int
    {
        return Facility::where(['id' => $id, 'user_id' => $userId])->delete();
    }

    private function saveRelations(Facility $client, array $data): void
    {
        foreach ($data['expenses'] as $expense) {
            $facilityExpenses[] = [
                'title'    => $expense['title'],
                'price'    => $expense['price']['nominal'],
                'currency' => $expense['price']['currency'],
                'number'   => $expense['number'],
            ];
        }
        if (!empty($facilityExpenses)) {
            $client->expenses()->createMany($facilityExpenses);
        }
    }
}
