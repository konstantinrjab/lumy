<?php

use App\Database\Models\Client;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    public const COUNT = 20;

    public function run()
    {
        $faker = Faker\Factory::create();

        for ($count = 1; $count <= self::COUNT; $count++) {
            Client::create([
                'user_id'  => rand(1, UsersTableSeeder::COUNT),
                'name'     => $faker->firstName,
                'surname'  => $faker->lastName,
                'patronymic' => 'p_' . $faker->firstName,
                'comment' => $faker->text(100)
            ]);
        }
    }
}
