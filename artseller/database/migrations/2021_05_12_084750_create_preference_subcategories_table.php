<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreferenceSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preference_subcategories', function (Blueprint $table) {
            $table->increments('preference_subcategories_id');
            $table->string('preference_subcategories_name');
             $table->string('language')->nullable();
            $table->integer('id')->unsigned();
            $table->foreign('id')->references('id')->on('preferences');
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
        Schema::dropIfExists('preference_subcategories');
    }
}
