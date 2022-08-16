<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertismentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisments', function (Blueprint $table) {
            $table->increments('ads_id');
            $table->integer('post_id')->nullable();
            $table->integer('store_id')->nullable();
            $table->integer('register_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->string('type');
            $table->string('audience_type');
            $table->integer('budget');
            $table->string('duration');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('payment_method');
            $table->tinyInteger('is_approval')->default('0');
             $table->tinyInteger('is_deleted')->default('0');
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
        Schema::dropIfExists('advertisments');
    }
}
