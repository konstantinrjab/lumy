<?php

use App\Database\Models\Profile;
use App\Database\Models\Role;
use App\Database\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminInit extends Migration
{
    private const ADMIN_EMAIL = 'admin@mail.com';
    private const ADMIN_NAME = 'Admin';
    private const ADMIN_PASSWORD = 'LumyAdm!n';
    private const ADMIN_API_TOKEN = 'SdOyZRAUq6C7kRwGWBOMLivUoTmdiATMFP53Bdf5FUWC3m3i7XtUXT0I6aF3';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $role = Role::create([
            'name' => 'admin',
            'slug' => 'admin',
        ]);

        $user = User::create([
            'name'      => self::ADMIN_NAME,
            'email'     => self::ADMIN_EMAIL,
            'password'  => Hash::make(self::ADMIN_PASSWORD),
            'api_token' => self::ADMIN_API_TOKEN
        ]);

        Profile::create([
            'user_id'                 => $user->id,
            'work_hours_in_month'     => 10,
            'desired_income_nominal'  => 100,
            'desired_income_currency' => 'uah',
            'language'                => 'ru',
            'theme'                   => 'dark',
        ]);

        DB::table('users_roles')->insert([
            'user_id' => $user->id,
            'role_id' => $role->id
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users_roles')
            ->leftJoin('users', 'users_roles.user_id', '=', 'users.id')
            ->leftJoin('roles', 'users_roles.role_id', '=', 'roles.id')
            ->where(['roles.name' => 'admin', 'users.email' => self::ADMIN_EMAIL])
            ->delete();

        DB::table('profiles')
            ->leftJoin('users', 'profiles.user_id', '=', 'users.id')
            ->where(['users.email' => self::ADMIN_EMAIL])
            ->delete();

        DB::table('users')
            ->where(['email' => self::ADMIN_EMAIL])
            ->delete();
    }
}
