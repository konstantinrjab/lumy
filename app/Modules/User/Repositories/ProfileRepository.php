<?php

namespace App\Modules\User\Repositories;

use App\Modules\User\Models\Profile;

class ProfileRepository
{
    public function getByUserId(int $userId): Profile
    {
        return Profile::where('user_id', $userId)->first();
    }

    public function updateByUserId(int $userId, array $data): bool
    {
        return Profile::where(['user_id' => $userId])->firstOrFail()->update($data);
    }
}
