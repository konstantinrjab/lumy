<?php

namespace App\Database\Repositories;

use App\Database\Models\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Exception;

class ClientRepository
{
    public function getByIdAndUserIdOrFail(int $id, int $userId): Client
    {
        return Client::where(['id' => $id, 'user_id' => $userId])->firstOrFail();
    }

    public function getAllByUserId(int $userId): Collection
    {
        return Client::where('user_id', $userId)->get();
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
            throw new Exception('Cannot update client');
        }

        return true;
    }

    public function delete(int $id, int $userId): int
    {
        return Client::where(['id' => $id, 'user_id' => $userId])->delete();
    }

    private function saveRelations(Client $client, array $data): void
    {
        foreach ($data['emails'] as $email) {
            $clientEmails[]['email'] = $email;
        }
        foreach ($data['phones'] as $phone) {
            $clientPhones[]['phone'] = $phone;
        }
        if (!empty($clientEmails)) {
            $client->emails()->createMany($clientEmails);
        }
        if (!empty($clientPhones)) {
            $client->phones()->createMany($clientPhones);
        }
    }
}
