<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ArticleCategorySeeder::class,
            TopicCategorySeeder::class,
            UserSeeder::class,
            NavigationSeeder::class,
            BadgeSeeder::class,
            SlideSeeder::class,
            ArticleSeeder::class,
            FurniCategorySeeder::class
        ]);
    }
}
