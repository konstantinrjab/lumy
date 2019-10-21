<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilityExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('facility_id')->unsigned();
            $table->string('title', 100);
            $table->decimal('price', 11, 2)->unsigned();
            $table->char('currency', 5);
            $table->integer('number')->unsigned();
            $table->timestamps();

            $table->foreign('facility_id')->references('id')->on('facilities')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facility_expenses');
    }
}
