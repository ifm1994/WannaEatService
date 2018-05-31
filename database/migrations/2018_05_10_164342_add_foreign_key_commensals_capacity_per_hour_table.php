<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyCommensalsCapacityPerHourTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commensals_capacity_per_hour', function ($table) {
            $table->foreign('id_restaurant')->references('id')->on('restaurants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commensals_capacity_per_hour', function ($table) {
            $table->dropForeign('id_restaurant');
        });

    }
}
