<?php

namespace App\Database\Repositories;

use App\Database\Models\Client;
use Illuminate\Database\Eloquent\Collection;

class ClientRepository
{
    public function get(int $clientId): ?Client
    {
        return Client::find($clientId);
    }

    public function all(): Collection
    {
        return Client::all();
    }

    public function getByUserId(int $userId): Collection
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
            $related[]['email'] = $email;
        }
        if (isset($related)) {
            $client->emails()->createMany($related);
        }

        return $client;
    }

    public function update(int $clientId, array $data)
    {
        Client::find($clientId)->update($data);
    }

    public function delete(int $clientId): int
    {
        return Client::destroy($clientId);
    }
}
