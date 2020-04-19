<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessbillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messbills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('months');
            $table->integer('years');
            $table->integer('daily_messing')->nullable();
            $table->integer('tea_break')->nullable();
            $table->integer('chit_bill')->nullable();
            $table->integer('party_bill')->nullable();
            $table->integer('sports_subscription')->nullable();
            $table->integer('mess_maint')->nullable();
            $table->integer('gass_bill')->nullable();
            $table->integer('indi_saving')->nullable();
            $table->integer('guest_room')->nullable();
            $table->integer('arrears')->nullable();
            $table->integer('on_payment')->nullable();
            $table->integer('others')->nullable();
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
        Schema::dropIfExists('messbills');
    }
}
