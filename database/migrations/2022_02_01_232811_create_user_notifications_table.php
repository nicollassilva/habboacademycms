<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_notifications', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('to_user_id');
            $table->unsignedBigInteger('from_user_id');

            $table->enum('type', ['mention', 'comment', 'author', 'staff', 'warning', 'info'])->default('info');

            $table->string('title');
            $table->string('slug')->nullable();

            $table->boolean('user_saw')->default(false);

            $table->timestamps();

            $table->foreign('to_user_id')
                ->references('id')
                ->on('users');

            $table->foreign('from_user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_notifications');
    }
}
