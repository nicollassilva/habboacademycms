<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBadgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('badges', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('description')->nullable();

            $table->string('code', 10)
                ->index()
                ->unique();
            $table->string('image_path');

            $table->enum('rarity', ['normal', 'event', 'promo', 'very', 'staff'])
                ->default('normal');

            $table->string('content_slug')->nullable();

            $table->timestamps();
        });

        Schema::create('user_badges', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('badge_id')->index();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('badge_id')
                ->references('id')
                ->on('badges')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('badges');
        Schema::dropIfExists('user_badges');
    }
}
