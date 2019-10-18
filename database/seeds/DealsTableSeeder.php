<?php

use App\Database\Models\Deal;
use App\Entities\Enum\CurrencyEnum;
use Illuminate\Database\Seeder;

class DealsTableSeeder extends Seeder
{
    public const COUNT = 20;

    public function run()
    {
        $faker = Faker\Factory::create();
        $currencies = CurrencyEnum::getValues();

        for ($count = 1; $count <= self::COUNT; $count++) {
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
