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
            $table->increments('order_id');
            $table->integer('register_id')->nullable();
            $table->integer('product_id')->nullable();
             $table->integer('store_id')->nullable();
             $table->string('orders_id')->nullable();
            $table->integer('payment')->nullable();
            $table->string('payment_method')->nullable();
            $table->date('dates');
            $table->time('times');
            $table->tinyInteger('is_approval')->default('0');
            $table->tinyInteger('is_cancelled')->default('0');
             $table->sstring('status')->nullable();
            $table->string('cancel_reason')->nullable();
            $table->date('cancel_date')->nullable();
            $table->time('cancel_time')->nullable();
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
