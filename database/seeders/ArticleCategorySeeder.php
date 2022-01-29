<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article\ArticleCategory;

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
