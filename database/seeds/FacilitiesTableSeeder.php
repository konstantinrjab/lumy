<?php

use App\Database\Models\Facility;
use App\Entities\Enum\CurrencyEnum;
use Illuminate\Database\Seeder;

class FacilitiesTableSeeder extends Seeder
{
    public const COUNT = 20;

    public function run()
    {
        $faker = Faker\Factory::create();
        $currencies = CurrencyEnum::getValues();

        for ($count = 1; $count <= self::COUNT; $count++) {
            Facility::create([
                'user_id'  => rand(1, UsersTableSeeder::COUNT),
                'title'     => $faker->words(3, true),
                'price'  => $faker->randomFloat(2, 10, 100),
                'currency'  => $faker->randomElement($currencies),
                'working_time'  => $faker->numberBetween(600, 1800),
                'transport_time'  => $faker->numberBetween(0, 10800),
                'deadline_time'  => $faker->numberBetween(0, 10800),
            ]);
        }
    }
}
