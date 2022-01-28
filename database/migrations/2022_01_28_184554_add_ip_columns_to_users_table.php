<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIpColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('ip_register', 50)
                ->after('name');

            $table->string('ip_last_login', 50)
                ->after('ip_register');

            $table->timestamp('last_login')
                ->after('ip_last_login');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('ip_register');
            $table->dropColumn('ip_last_login');
            $table->dropColumn('last_login');
        });
    }
}
