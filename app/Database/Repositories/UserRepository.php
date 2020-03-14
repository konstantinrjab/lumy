<?php

namespace App\Database\Repositories;

use App\Modules\User\Models\Profile;
use App\Modules\User\Models\User;
use App\Modules\User\Models\UsersSocial;
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
            Profile::create([
                'user_id'                 => $user->id,
                'work_hours_in_month'     => Profile::DEFAULT_WORK_HOURS_IN_MONTH,
                'desired_income_nominal'  => Profile::DEFAULT_DESIRED_INCOME_NOMINAL,
                'desired_income_currency' => Profile::DEFAULT_DESIRED_INCOME_CURRENCY,
                'language'                => Profile::DEFAULT_LANGUAGE,
                'theme'                   => Profile::DEFAULT_THEME,
            ]);

            DB::commit();
        } catch (QueryException $exception) {
            DB::rollback();
            throw $exception;
        }

        return $user;
    }

    public function createFromGoogle(array $userData, string $googleId, string $credentials): User
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
                'google_credentials' => $credentials,
            ]);

            Profile::create([
                'user_id'                 => $user->id,
                'work_hours_in_month'     => Profile::DEFAULT_WORK_HOURS_IN_MONTH,
                'desired_income_nominal'  => Profile::DEFAULT_DESIRED_INCOME_NOMINAL,
                'desired_income_currency' => Profile::DEFAULT_DESIRED_INCOME_CURRENCY,
                'language'                => Profile::DEFAULT_LANGUAGE,
                'theme'                   => Profile::DEFAULT_THEME,
            ]);

            DB::commit();
        } catch (QueryException $exception) {
            DB::rollback();
            throw $exception;
        }

        return $user;
    }
}
