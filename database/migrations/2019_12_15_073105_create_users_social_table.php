<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersSocialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_socials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('google_id')->unique()->nullable()->default(null);
            $table->text('google_credentials')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });

        DB::statement('INSERT INTO users_socials (user_id, google_id) SELECT id, google_id FROM users');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('google_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_socials');
    }
}
