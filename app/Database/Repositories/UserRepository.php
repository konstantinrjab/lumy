<?php

namespace App\Database\Repositories;

use App\Database\Models\User\UsersProfile;
use App\Database\Models\User\User;
use App\Database\Models\User\UsersSocial;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository
{
    public function create(array $userData): User
    {
        DB::beginTransaction();

        try {
            $user = User::create([
                'name'      => $userData['name'],
                'email'     => $userData['email'],
                'password'  => isset($userData['password']) ? Hash::make($userData['password']) : null,
                'api_token' => Str::random(User::API_TOKEN_LENGTH)
            ]);
            UsersProfile::create([
                'user_id'                 => $user->id,
                'work_hours_in_month'     => UsersProfile::DEFAULT_WORK_HOURS_IN_MONTH,
                'desired_income_nominal'  => UsersProfile::DEFAULT_DESIRED_INCOME_NOMINAL,
                'desired_income_currency' => UsersProfile::DEFAULT_DESIRED_INCOME_CURRENCY,
                'language'                => UsersProfile::DEFAULT_LANGUAGE,
                'theme'                   => UsersProfile::DEFAULT_THEME,
            ]);

            DB::commit();
        } catch (QueryException $exception) {
            DB::rollback();
            throw $exception;
        }

        return $user;
    }

    public function createFromGoogle(array $userData, string $googleId, string $googleToken)
    {
        DB::beginTransaction();

        try {
            $user = User::create([
                'name'      => $userData['name'],
                'email'     => $userData['email'],
                'api_token' => Str::random(User::API_TOKEN_LENGTH)
            ]);
            UsersSocial::create([
                'user_id' => $user->id,
                'google_id' => $googleId,
                'google_token' => $googleToken,
            ]);

            UsersProfile::create([
                'user_id'                 => $user->id,
                'work_hours_in_month'     => UsersProfile::DEFAULT_WORK_HOURS_IN_MONTH,
                'desired_income_nominal'  => UsersProfile::DEFAULT_DESIRED_INCOME_NOMINAL,
                'desired_income_currency' => UsersProfile::DEFAULT_DESIRED_INCOME_CURRENCY,
                'language'                => UsersProfile::DEFAULT_LANGUAGE,
                'theme'                   => UsersProfile::DEFAULT_THEME,
            ]);

            DB::commit();
        } catch (QueryException $exception) {
            DB::rollback();
            throw $exception;
        }

        return $user;
    }
}
