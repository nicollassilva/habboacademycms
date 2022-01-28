<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'Admin',
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'ip_register' => 'localhost',
            'ip_last_login' => 'localhost',
            'last_login' => \Carbon\Carbon::now(),
            'password' => Hash::make('admin')
        ]);
    }
}
