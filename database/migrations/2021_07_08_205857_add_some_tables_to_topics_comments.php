<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeTablesToTopicsComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('topics_comments', function (Blueprint $table) {
            $table->boolean('active')
                ->default(true)
                ->after('content');

            $table->enum('moderated', ['moderated', 'pending'])
                ->default('pending')
                ->after('active');

            $table->string('moderator')
                ->nullable()
                ->after('moderated');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('topics_comments', function (Blueprint $table) {
            $table->dropColumn('active');
            $table->dropColumn('moderated');
            $table->dropColumn('moderator');
        });
    }
}
