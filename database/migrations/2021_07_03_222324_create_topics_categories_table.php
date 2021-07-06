<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics_categories', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();
            $table->string('icon')->nullable();
        });

        DB::table('topics_categories')->insert([
            ['name' => 'HabboAcademy'],
            ['name' => 'Apresentação'],
            ['name' => 'Dúvidas'],
            ['name' => 'Novidades'],
            ['name' => 'Eventos/Promoções'],
            ['name' => 'Vídeos/Músicas'],
            ['name' => 'Habbo'],
            ['name' => 'Jogos'],
            ['name' => 'Sugestões'],
            ['name' => 'Humor'],
            ['name' => 'Outros'],
            ['name' => 'Trocas e Negócios'],
            ['name' => 'Curiosidades'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics_categories');
    }
}
