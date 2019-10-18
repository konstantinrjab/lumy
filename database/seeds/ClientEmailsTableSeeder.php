<?php

use App\Database\Models\Client;
use App\Database\Models\ClientEmail;
use Illuminate\Database\Seeder;

class ClientEmailsTableSeeder extends Seeder
{
    public const COUNT = 50;

    public function run()
    {
        $faker = Faker\Factory::create();

        for ($clientsCount = 1; $clientsCount <= self::COUNT; $clientsCount++) {
            ClientEmail::create([
                'client_id'  => rand(1, ClientsTableSeeder::COUNT),
                'email'     => $faker->email,
            ]);
        }
    }
}
