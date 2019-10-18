<?php

use App\Database\Models\Client;
use App\Database\Models\ClientEmail;
use App\Database\Models\ClientPhone;
use Illuminate\Database\Seeder;

class ClientPhonesTableSeeder extends Seeder
{
    public const COUNT = 50;

    public function run()
    {
        $faker = Faker\Factory::create();

        for ($count = 1; $count <= self::COUNT; $count++) {
            ClientPhone::create([
                'client_id'  => rand(1, ClientsTableSeeder::COUNT),
                'phone'     => $faker->phoneNumber,
            ]);
        }
    }
}