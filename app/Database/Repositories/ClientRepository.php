<?php

namespace App\Database\Repositories;

use App\Database\Models\Client;
use Illuminate\Database\Eloquent\Collection;

class ClientRepository
{
    public function getByIdAndUserId(int $id, int $userId): ?Client
    {
        return Client::where(['id' => $id, 'user_id' => $userId])->first();
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
        foreach ($data['emails'] as $email) {
            $related['emails'][]['email'] = $email;
        }
        foreach ($data['phones'] as $phone) {
            $related['phones'][]['phone'] = $phone;
        }
        if (isset($related['emails'])) {
            $client->emails()->createMany($related['emails']);
        }
        if (isset($related['phones'])) {
            $client->phones()->createMany($related['phones']);
        }

        return $client;
    }

    public function update(int $id, array $data, int $userId): bool
    {
        return Client::where(['id' => $id, 'user_id' => $userId])->firstOrFail()->update($data);
    }

    public function delete(int $id, int $userId): int
    {
        return Client::where(['id' => $id, 'user_id' => $userId])->delete();
    }
}
