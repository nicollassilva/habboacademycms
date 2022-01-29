<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigations', function (Blueprint $table) {
            $table->id();

            $table->string('label');

            $table->string('small_icon')->nullable();
            $table->string('hover_icon')->nullable();
            $table->string('slug')->nullable();

            $table->smallInteger('order')->default(0);
            $table->boolean('visible')->default(true);
        });

        Schema::create('sub_navigations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('navigation_id');

            $table->string('label');
            $table->string('slug')->nullable();
            $table->boolean('new_tab')->default(false);

            $table->smallInteger('order')->default(0);
            $table->boolean('visible')->default(true);

            $table->foreign('navigation_id')
                ->references('id')
                ->on('navigations')
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
        Schema::dropIfExists('navigations');
        Schema::dropIfExists('sub_navigations');
    }
}
