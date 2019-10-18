<?php

use App\Database\Models\Deal;
use App\Entities\Enum\Currency;
use Illuminate\Database\Seeder;

class DealsTableSeeder extends Seeder
{
    public const COUNT = 20;

    public function run()
    {
        $faker = Faker\Factory::create();
        $reflectionClass = new ReflectionClass(Currency::class);
        $currencies = $reflectionClass->getConstants();

        for ($clientsCount = 1; $clientsCount <= self::COUNT; $clientsCount++) {
            Deal::create([
                'user_id'  => rand(1, UsersTableSeeder::COUNT),
                'title'     => $faker->words(3, true),
                'address'  => $faker->address,
                'price'  => $faker->randomFloat(2, 10, 100),
                'currency'  => $faker->randomElement($currencies),
                'deadline'  => $faker->dateTime(),
                'dateTime'  => $faker->dateTime(),
            ]);
        }
    }
}
