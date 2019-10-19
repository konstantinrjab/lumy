<?php

namespace App\Database\Repositories;

use App\Database\Models\Profile;
use App\Database\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Exception;

class UserRepository
{
    public function create(array $data): User
    {
        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'api_token' => Str::random(60)
            ]);
            Profile::create([
                'user_id'             => $user->id,
                'work_hours_in_month' => Profile::PROFILE_DEFAULT_WORK_HOURS_IN_MONTH,
                'salary'              => Profile::PROFILE_DEFAULT_SALARY,
                'currency'            => Profile::PROFILE_DEFAULT_CURRENCY,
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

       return $user;
    }
}
