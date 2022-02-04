<?php

namespace Database\Seeders;

use App\Models\Furni\FurniCategory;
use Illuminate\Database\Seeder;

class FurniCategorySeeder extends Seeder
{
    protected $categories = [
        'Sorveteiras',
        'Totens',
        'Serpentes',
        'Aleatórios',
        'Raros de Diamante',
        'Ventiladores',
        'Tronos',
        'Customizados',
        'Portas Sci-Fi',
        'Toldos',
        'Sacos de Dormir',
        'Pilares',
        'Máquinas de Fumaça',
        'Sofás',
        'Mamutes',
        'Guarda-Sol',
        'Chafariz',
        'Catracas',
        'Bonnies',
        'Âmbares',
        'Pisos Raros',
        'Ovos',
        'Máquina de Refrigerante',
        'Leviathans',
        'Holos'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect($this->categories)
            ->each(function($category) {
                FurniCategory::create([
                    'name' => $category
                ]);
            });
    }
}
