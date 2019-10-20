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
                'name'      => $data['name'],
                'email'     => $data['email'],
                'password'  => Hash::make($data['password']),
                'api_token' => Str::random(60)
            ]);
            Profile::create([
                'user_id'                 => $user->id,
                'work_hours_in_month'     => Profile::DEFAULT_WORK_HOURS_IN_MONTH,
                'desired_income_nominal'  => Profile::DEFAULT_DESIRED_INCOME_NOMINAL,
                'desired_income_currency' => Profile::DEFAULT_DESIRED_INCOME_CURRENCY,
                'language'                => Profile::DEFAULT_LANGUAGE,
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception('Cannot create user');
        }

        return $user;
    }
}
