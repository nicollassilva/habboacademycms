<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFurniValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('furni_categories', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('icon')->nullable();
        });

        Schema::create('furni_values', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('admin_id');

            $table->integer('price')->nullable();

            $table->enum('price_type', ['coins', 'diamonds', 'duckets'])->default('coins');
            $table->enum('state', ['up', 'down', 'regular'])->default('regular');

            $table->string('icon_path')->nullable();
            $table->string('image_path');

            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('furni_categories');

            $table->foreign('admin_id')
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
        Schema::dropIfExists('furni_categories');
        Schema::dropIfExists('furni_values');
    }
}
