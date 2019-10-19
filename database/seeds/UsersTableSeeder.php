<?php

use App\Database\Models\User;
use App\Database\Repositories\UserRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public const COUNT = 5;

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function run()
    {
        $faker = Faker\Factory::create();
        for ($count = 1; $count <= self::COUNT; $count++) {
            $data = [
                'name'      => $faker->name,
                'email'     => $faker->email,
                'password'  => Hash::make(Str::random()),
                'api_token' => $count == 1 ? 'Oa8cduFPjvzG4LYcWAVCHhlB8gfDlWZvROQ10qoODq0eTLEkFq518rDwCc5R' : Str::random(60),
            ];
            $this->userRepository->create($data);
        }
    }
}
