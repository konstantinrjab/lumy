<?php

use App\Database\Models\Profile;
use App\Database\Models\User;
use App\Entities\Enum\LanguageEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public const COUNT = 5;

    private const ADMIN_EMAIL = 'admin@mail.com';
    private const ADMIN_NAME = 'Admin';
    private const ADMIN_PASSWORD = 'LumyAdm!n';
    private const ADMIN_API_TOKEN = 'Oa8cduFPjvzG4LYcWAVCHhlB8gfDlWZvROQ10qoODq0eTLEkFq518rDwCc5R';

    public function run()
    {
        $languages = LanguageEnum::getValues();

        $faker = Faker\Factory::create();
        for ($count = 1; $count <= self::COUNT; $count++) {
            $user = User::create([
                'name'      => $count == 1 ? self::ADMIN_NAME : $faker->name,
                'email'     => $count == 1 ? self::ADMIN_EMAIL : $faker->email,
                'password'  => $count == 1 ? Hash::make(self::ADMIN_PASSWORD) : Hash::make(Str::random()),
                'api_token' => $count == 1 ? self::ADMIN_API_TOKEN : Str::random(User::API_TOKEN_LENGTH)
            ]);
            Profile::create([
                'user_id'                 => $user->id,
                'work_hours_in_month'     => Profile::DEFAULT_WORK_HOURS_IN_MONTH,
                'desired_income_nominal'  => Profile::DEFAULT_DESIRED_INCOME_NOMINAL,
                'desired_income_currency' => Profile::DEFAULT_DESIRED_INCOME_CURRENCY,
                'language'                => $faker->randomElement($languages),
                'theme'                   => Profile::DEFAULT_THEME,
            ]);
        }
    }
}
