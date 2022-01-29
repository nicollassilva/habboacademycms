<?php

namespace Database\Seeders;

use App\Models\{User, Badge};
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $badge = Badge::create([
            'code' => 'STAFF',
            'rarity' => 'staff',
            'title' => 'Academy Staff',
            'description' => 'Sou staff da Academy!',
            'image_path' => 'https://images.habbo.com/c_images/album1584/ADM.gif'
        ]);

        $firstUser = User::firstOrFail();

        $firstUser->badges()->attach($badge);
    }
}
