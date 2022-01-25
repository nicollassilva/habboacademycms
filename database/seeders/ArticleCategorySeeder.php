<?php

namespace Database\Seeders;

use App\Models\Article\ArticleCategory;
use Illuminate\Database\Seeder;

class ArticleCategorySeeder extends Seeder
{
    protected $categories = [
        'HabboAcademy',
        'Novidades',
        'Promoções/Eventos',
        'Vídeos/Músicas',
        'Habbo',
        'Jogos',
        'Assuntos Externos',
        'Outros'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->categories as $category) {
            ArticleCategory::create([
                'name' => $category
            ]);
        }
    }
}
