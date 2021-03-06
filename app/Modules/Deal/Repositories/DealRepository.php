<?php

namespace App\Modules\Deal\Repositories;

use App\Modules\Deal\Models\Deal;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Exception;

class DealRepository
{
    public function getByIdAndUserIdOrFail(int $id, int $userId): Deal
    {
        return Deal::where(['id' => $id, 'user_id' => $userId])->firstOrFail();
    }

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

        $this->saveRelations($deal, $data);

        return $deal;
    }

    public function update(Deal $deal, array $data): bool
    {
        DB::beginTransaction();

        try {
            if (!$deal->update($data)) {
                throw new Exception('Deal update fails');
            }

            $deal->facilities()->delete();
            $this->saveRelations($deal, $data);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception('Deal update fails');
        }

        return true;
    }

    public function delete(int $id, int $userId): int
    {
        return Deal::where(['id' => $id, 'user_id' => $userId])->delete();
    }

    private function saveRelations(Deal $deal, array $data): void
    {
        if (empty($data['facilities'])) {
            return;
        }

        foreach ($data['facilities'] as $facility) {
            $dealFacilities[] = [
                'dela_id'     => $deal->id,
                'facility_id' => $facility['id'],
                'number'      => $facility['number'],
            ];
        }
        if (!empty($dealFacilities)) {
            $deal->facilities()->createMany($dealFacilities);
        }
    }
}
