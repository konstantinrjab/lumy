<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ClientsTableSeeder::class);
        $this->call(ClientPhonesTableSeeder::class);
        $this->call(ClientEmailsTableSeeder::class);
        $this->call(DealsTableSeeder::class);
        $this->call(FacilitiesTableSeeder::class);
        $this->call(ExpensesTableSeeder::class);
        $this->call(FaqTableSeeder::class);
    }
}
