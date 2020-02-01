<?php

use App\Database\Models\User\Profile;
use App\Database\Models\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Enum\LanguageEnum;
use Carbon\Carbon;

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
            Profile::create([
                'user_id'                 => $user->id,
                'work_hours_in_month'     => Profile::DEFAULT_WORK_HOURS_IN_MONTH,
                'desired_income_nominal'  => Profile::DEFAULT_DESIRED_INCOME_NOMINAL,
                'desired_income_currency' => Profile::DEFAULT_DESIRED_INCOME_CURRENCY,
                'language'                => $faker->randomElement($languages),
                'theme'                   => Profile::DEFAULT_THEME,
                'created_at'              => Carbon::now()->toDateTimeString()
            ]);
        }
    }
}
