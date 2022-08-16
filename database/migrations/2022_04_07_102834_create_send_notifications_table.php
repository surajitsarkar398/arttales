<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSendNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('send_notifications', function (Blueprint $table) {
            $table->increments('send_notifications_id');
            $table->increments('register_id');
            $table->increments('requested_id');
            $table->increments('post_id');
            $table->increments('comment_id');
            $table->increments('order_id');
            $table->increments('send_notification_id');
            $table->increments('order_id');
            $table->string('notification_type');
            $table->string('notification_time');
            $table->string('notification_to');
            $table->string('notification_text');
            $table->string('image');
            $table->integer('is_read')->nullable();
            $table->integer('is_deleted')->nullable(); 
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
        Schema::dropIfExists('send_notifications');
    }
}
