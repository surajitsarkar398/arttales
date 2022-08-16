<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('register_id');
            $table->string('name');
            $table->string('country_code');
            $table->string('mobile')->unique();
            $table->string('dob');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('repasswprd');
            $table->string('image')->nullable();
            $table->string('bio')->nullable();
            $table->string('website')->nullable();
            $table->string('major_achive')->nullable();
            $table->string('genres')->nullable();
            $table->string('work_at')->nullable();
            $table->string('performance')->nullable();
            $table->string('visiting_card')->nullable();
            $table->string('main_category_name')->nullable();
            $table->string('sub_category_name')->nullable();
            $table->string('role');
            $table->string('type')->default('Admin');
            $table->string('account_type')->default('Public');
            $table->tinyInteger('isban')->default('0');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
