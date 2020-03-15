<?php

namespace App\Modules\Client\Repositories;

use App\Modules\Client\Models\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Exception;

class ClientRepository
{
    public function getByIdAndUserIdOrFail(int $id, int $userId): Client
    {
        return Client::where(['id' => $id, 'user_id' => $userId])->firstOrFail();
    }

    public function getVisibleByUserId(int $userId): Collection
    {
        return Client::where(['user_id' => $userId, 'visibility' => Client::VISIBILITY_VISIBLE])->get();
    }

    public function create(array $data): ?Client
    {
        $client = new Client($data);

        if (!$client->save()) {
            return null;
        }
        $this->saveRelations($client, $data);

        return $client;
    }

    public function update(int $id, array $data, int $userId): bool
    {
        $client = $this->getByIdAndUserIdOrFail($id, $userId);

        DB::beginTransaction();

        try {
            if (!$client->update($data)) {
                throw new Exception();
            }

            $client->emails()->delete();
            $client->phones()->delete();
            $this->saveRelations($client, $data);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception('Update fails');
        }

        return true;
    }

    public function deleteOrHide(int $id, int $userId): bool
    {
        try {
            $result = Client::where(['id' => $id, 'user_id' => $userId])->delete();
        } catch (QueryException $exception) {
            $client = $this->getByIdAndUserIdOrFail($id, $userId);
            $result = $client->save(['visibility' => Client::VISIBILITY_HIDDEN]);
        }

        return $result;
    }

    private function saveRelations(Client $client, array $data): void
    {
        if (isset($data['emails'])) {
            foreach ($data['emails'] as $email) {
                $clientEmails[]['email'] = $email;
            }
        }
        if (isset($data['phones'])) {
            foreach ($data['phones'] as $phone) {
                $clientPhones[]['phone'] = $phone;
            }
        }
        if (!empty($clientEmails)) {
            $client->emails()->createMany($clientEmails);
        }
        if (!empty($clientPhones)) {
            $client->phones()->createMany($clientPhones);
        }
    }
}
