<?php

use App\Database\Models\User\UsersProfile;
use App\Database\Models\User\User;
use App\Entities\Enum\LanguageEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public const COUNT = 5;

    public function run(): void
    {
        $languages = LanguageEnum::getValues();

        $faker = Faker\Factory::create();
        for ($count = 1; $count <= self::COUNT; $count++) {
            $user = User::create([
                'name'      => $faker->name,
                'email'     => $faker->email,
                'password'  => Hash::make(Str::random()),
                'api_token' => Str::random(User::API_TOKEN_LENGTH)
            ]);
            UsersProfile::create([
                'user_id'                 => $user->id,
                'work_hours_in_month'     => UsersProfile::DEFAULT_WORK_HOURS_IN_MONTH,
                'desired_income_nominal'  => UsersProfile::DEFAULT_DESIRED_INCOME_NOMINAL,
                'desired_income_currency' => UsersProfile::DEFAULT_DESIRED_INCOME_CURRENCY,
                'language'                => $faker->randomElement($languages),
                'theme'                   => UsersProfile::DEFAULT_THEME,
            ]);
        }
    }
}
