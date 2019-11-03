<?php

use App\Faq;
use Illuminate\Database\Seeder;

class FaqTableSeeder extends Seeder
{
    private const COUNT = 20;

    public function run()
    {
        $faker = Faker\Factory::create();

        for ($count = 1; $count <= self::COUNT; $count++) {
            Faq::create([
                'alias'      => $faker->word,
                'title'      => $faker->sentence,
                'text'       => $faker->text,
            ]);
        }
    }
}
