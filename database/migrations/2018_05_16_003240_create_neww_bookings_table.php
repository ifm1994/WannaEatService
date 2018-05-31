<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewwBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('id_restaurant');
            $table->integer('id_user');
            $table->string('time');
            $table->float('price');
            $table->string('id_transaction');
            $table->string('products_and_amount');
            $table->string('payment_method');
            $table->string('client_name');
            $table->string('client_phone');
            $table->string('client_email');
            $table->string('number_of_commensals');
            $table->string('client_commentary');
            $table->boolean('canrate');
            $table->integer('status');
            $table->foreign('id_restaurant')->references('id')->on('restaurants')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('bookings');
    }
}
