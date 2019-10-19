<?php

use App\Database\Models\Profile;
use App\Database\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public const COUNT = 5;

    public function run()
    {
        $faker = Faker\Factory::create();
        for ($count = 1; $count <= self::COUNT; $count++) {
            $user = User::create([
                'name' => $faker->name,
                'email' => $count == 1 ? 'user@mail.com' : $faker->email,
                'password' => Hash::make(Str::random()),
                'api_token' =>  $count == 1 ? 'Oa8cduFPjvzG4LYcWAVCHhlB8gfDlWZvROQ10qoODq0eTLEkFq518rDwCc5R' : Str::random(60)
            ]);
            Profile::create([
                'user_id'             => $user->id,
                'work_hours_in_month' => Profile::PROFILE_DEFAULT_WORK_HOURS_IN_MONTH,
                'salary'              => Profile::PROFILE_DEFAULT_SALARY,
                'currency'            => Profile::PROFILE_DEFAULT_CURRENCY,
            ]);
        }
    }
}
