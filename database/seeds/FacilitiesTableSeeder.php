<?php

use App\Database\Models\Facility;
use App\Database\Models\FacilityExpense;
use App\Entities\Enum\CurrencyEnum;
use Illuminate\Database\Seeder;

class FacilitiesTableSeeder extends Seeder
{
    public const COUNT = 20;

    public function run(): void
    {
        $faker = Faker\Factory::create();
        $currencies = CurrencyEnum::getValues();

        for ($count = 1; $count <= self::COUNT; $count++) {
            $facility = Facility::create([
                'user_id'        => rand(1, UsersTableSeeder::COUNT),
                'title'          => $faker->words(3, true),
                'price'          => $faker->randomFloat(2, 10, 100),
                'is_active'      => $faker->boolean,
                'currency'       => $faker->randomElement($currencies),
                'working_time'   => $faker->numberBetween(600, 1800),
                'transport_time' => $faker->numberBetween(0, 10800),
                'deadline_time'  => $faker->numberBetween(0, 10800),
            ]);
            for ($expenseCount = 1; $expenseCount <= 2; $expenseCount++) {
                FacilityExpense::create([
                    'facility_id' => $facility->id,
                    'title'       => $faker->words(3, true),
                    'price'       => $faker->randomFloat(2, 10, 100),
                    'currency'    => $faker->randomElement($currencies),
                    'number'      => $faker->numberBetween(1, 20),
                ]);
            }
        }
    }
}
