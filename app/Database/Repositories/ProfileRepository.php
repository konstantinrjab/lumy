<?php

namespace App\Database\Repositories;

use App\Database\Models\Profile;

class ProfileRepository
{
    public function get(int $id): ?Profile
    {
        return Profile::find($id);
    }

    public function getByUserId(int $userId): Profile
    {
        return Profile::where('user_id', $userId)->first();
    }

    public function update(int $id, array $data): bool
    {
        return Profile::findOrFail($id)->update($data);
    }
}
