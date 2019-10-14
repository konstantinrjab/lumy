<?php

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
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make(Str::random()),
                'api_token' => Str::random(60),
            ]);
        }
    }
}