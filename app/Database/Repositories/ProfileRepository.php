<?php

namespace App\Database\Repositories;

use App\Database\Models\User\UsersProfile;

class ProfileRepository
{
    public function getByUserId(int $userId): UsersProfile
    {
        return UsersProfile::where('user_id', $userId)->first();
    }

    public function updateByUserId(int $userId, array $data): bool
    {
        return UsersProfile::where(['user_id' => $userId])->firstOrFail()->update($data);
    }
}
