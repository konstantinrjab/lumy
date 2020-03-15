<?php

use App\Modules\Client\Models\Client;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    public const COUNT = 20;

    public function run(): void
    {
        $faker = Faker\Factory::create();

        for ($count = 1; $count <= self::COUNT; $count++) {
            Client::create([
                'user_id'    => rand(1, UsersTableSeeder::COUNT),
                'visibility' => Client::VISIBILITY_VISIBLE,
                'name'       => $faker->firstName,
                'surname'    => $faker->lastName,
                'patronymic' => 'p_' . $faker->firstName,
                'comment'    => $faker->text(100)
            ]);
        }
    }
}
