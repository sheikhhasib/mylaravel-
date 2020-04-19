<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->integer('guest')->nullable();
            $table->enum('meal_time',['Breakfast','Lunch','Tea Break','Dinner','Chit','Party'])->nullable();
            $table->integer('item_id')->default(0);
            $table->double('qty',10,2)->default(0);
            $table->double('price',10,2)->default(0);
            $table->string('order_date');
            $table->enum('status', ['Active','Inactive','Pending','Deleted','Banned'])->default('Active');
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
        Schema::dropIfExists('orders');
    }
}
