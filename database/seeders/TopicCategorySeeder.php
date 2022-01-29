<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Topic\TopicCategory;

class TopicCategorySeeder extends Seeder
{
    protected $categories = [
        'HabboAcademy',
        'Apresentação',
        'Dúvidas',
        'Novidades',
        'Eventos/Promoções',
        'Vídeos/Músicas',
        'Habbo',
        'Jogos',
        'Sugestões',
        'Humor',
        'Outros',
        'Trocas e Negócios',
        'Curiosidades'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->categories as $category) {
            TopicCategory::create([
                'name' => $category
            ]);
        }
    }
}
