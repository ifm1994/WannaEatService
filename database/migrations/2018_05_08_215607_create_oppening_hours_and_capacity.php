<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOppeningHoursAndCapacity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commensals_capacity_per_hour', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('id_restaurant');
            $table->string('hour');
            $table->integer('commensal_capacity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commensals_capacity_per_hour');
    }
}
