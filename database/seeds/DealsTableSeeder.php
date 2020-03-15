<?php

use App\Modules\Deal\Models\Deal;
use App\Modules\Deal\Models\DealFacility;
use App\Enum\CurrencyEnum;
use App\Modules\Deal\Enum\DealStatusEnum;
use Illuminate\Database\Seeder;

class DealsTableSeeder extends Seeder
{
    public const COUNT = 20;

    public function run(): void
    {
        $faker = Faker\Factory::create();
        $currencies = CurrencyEnum::getValues();
        $statuses = DealStatusEnum::getValues();

        for ($count = 1; $count <= self::COUNT; $count++) {
            $deal = Deal::create([
                'user_id'  => rand(1, UsersTableSeeder::COUNT),
                'client_id'  => rand(1, ClientsTableSeeder::COUNT),
                'status'  => $faker->randomElement($statuses),
                'title'     => $faker->words(3, true),
                'address'  => $faker->address,
                'price'  => $faker->randomFloat(2, 10, 100),
                'currency'  => $faker->randomElement($currencies),
                'prepay_price'  => $faker->randomFloat(2, 0, 10),
                'prepay_currency'  => $faker->randomElement($currencies),
                'deadline'  => $faker->dateTime(),
                'comment'  => $faker->text(),
                'start'  => $faker->dateTime(),
                'end'  => $faker->dateTime(),
            ]);
            DealFacility::create([
                'deal_id'  => $deal->id,
                'facility_id'  => rand(1, FacilitiesTableSeeder::COUNT),
                'number'     => $faker->numberBetween(1, 10),
            ]);
        }
    }
}
