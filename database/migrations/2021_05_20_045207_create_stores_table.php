<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
        $table->increments('store_id');
        $table->string('store_code');
            $table->string('store_name');
            $table->string('store_image');
            $table->string('category');
            $table->string('mobile');
            $table->string('email');
            $table->string('website')->nullable();
            $table->string('address')->nullable();
            $table->string('attachment');
            $table->tinyInteger('is_approval')->default('0');
            $table->tinyInteger('is_deleted')->default('0');
            $table->tinyInteger('isban')->default('0');
            $table->integer('register_id')->nullable()->unsigned();
            $table->foreign('register_id')->references('register_id')->on('users');
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
        Schema::dropIfExists('stores');
    }
}

