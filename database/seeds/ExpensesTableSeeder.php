<?php

use App\Modules\Expense\Models\Expense;
use App\Common\Enums\CurrencyEnum;
use App\Modules\Expense\Enum\ExpenseTypeEnum;
use Illuminate\Database\Seeder;

class ExpensesTableSeeder extends Seeder
{
    public const COUNT = 20;

    public function run(): void
    {
        $faker = Faker\Factory::create();
        $currencies = CurrencyEnum::getValues();
        $types = ExpenseTypeEnum::getValues();

        for ($count = 1; $count <= self::COUNT; $count++) {
            Expense::create([
                'user_id'  => rand(1, UsersTableSeeder::COUNT),
                'title'    => $faker->words(3, true),
                'price'    => $faker->randomFloat(2, 10, 100),
                'currency' => $faker->randomElement($currencies),
                'type'     => $faker->randomElement($types),
                'is_active' => $faker->boolean,
            ]);
        }
    }
}
