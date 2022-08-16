<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('product_name');
            $table->string('price');
            $table->string('discount');
            $table->string('offer_price');
            $table->text('product_image');
            $table->string('product_description');
            $table->integer('limited_stock')->nullable();
            $table->integer('sell_product')->nullable();
           $table->integer('post_id')->nullable()->unsigned();
            $table->foreign('post_id')->references('post_id')->on('posts');
            $table->integer('register_id')->nullable();
            $table->integer('store_id')->nullable();
            $table->string('payment_method')->nullable();
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
        Schema::dropIfExists('products');
    }
}
