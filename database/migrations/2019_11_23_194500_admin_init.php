<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminInit extends Migration
{
    private const ADMIN_EMAIL = 'admin@mail.com';
    private const ADMIN_NAME = 'Admin';
    private const ADMIN_PASSWORD = 'LumyAdm!n';
    private const ADMIN_API_TOKEN = 'SdOyZRAUq6C7kRwGWBOMLivUoTmdiATMFP53Bdf5FUWC3m3i7XtUXT0I6aF3';
    private const ROLE_ADMIN = 'admin';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('roles')->insert([
            'slug' => self::ROLE_ADMIN,
            'name' => self::ROLE_ADMIN,
        ]);

        DB::table('users')->insert([
            'name'      => self::ADMIN_NAME,
            'email'     => self::ADMIN_EMAIL,
            'password'  => Hash::make(self::ADMIN_PASSWORD),
            'api_token' => self::ADMIN_API_TOKEN
        ]);

        $userId = DB::table('users')
            ->select('id')
            ->where(['email' => self::ADMIN_EMAIL])
            ->first()
            ->id;
        $roleId = DB::table('roles')
            ->select('id')
            ->where([
                ['name', '=', self::ROLE_ADMIN],
                ['slug', '=', self::ROLE_ADMIN]
            ])
            ->first()
            ->id;

        DB::table('profiles')->insert([
            'user_id'                 => $userId,
            'work_hours_in_month'     => 10,
            'desired_income_nominal'  => 100,
            'desired_income_currency' => 'uah',
            'language'                => 'ru',
            'theme'                   => 'dark',
        ]);

        DB::table('users_roles')->insert([
            'user_id' => $userId,
            'role_id' => $roleId
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
            ->where(['roles.name' => self::ROLE_ADMIN, 'users.email' => self::ADMIN_EMAIL])
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
