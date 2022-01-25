<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id');

            $table->text('content');

            $table->enum('moderated', ['moderated', 'pending', 'closed'])->default('pending');
            $table->string('moderator')->nullable();

            $table->string('slug');
            $table->boolean('fixed')->default(false);

            $table->boolean('status')->default(true);

            $table->integer('comments_count')->default(0);

            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('topics_categories');

            $table->foreign('user_id')
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
        Schema::dropIfExists('topics');
    }
}
