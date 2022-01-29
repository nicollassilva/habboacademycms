<?php

namespace Database\Seeders;

use App\Models\Academy\Navigation;
use Illuminate\Database\Seeder;

class NavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $navigations = $this->getDefaultNavigations();

        collect($navigations)->each(
            function ($subNavigations, $navigationName) {

                $navigationObject = Navigation::create(
                    array_merge(
                        ['label' => $navigationName],
                        $this->getNavigationData($navigationName)
                    )
                );

                if (!$navigationObject) return;

                collect($subNavigations)->each(
                    function ($subNavigationName) use ($navigationObject) {

                        $navigationObject->subNavigations()->create([
                            'label' => $subNavigationName
                        ]);
                        
                    }
                );
            }
        );
    }

    public function getNavigationData(string $navigationLabel)
    {
        if ($navigationLabel == 'Início') {
            return [
                'order' => 0,
                'small_icon' => 'fas fa-house-user',
                'hover_icon' => '/images/menu/inicio.png'
            ];
        }

        if ($navigationLabel == 'HabboAcademy') {
            return [
                'order' => 1,
                'small_icon' => 'fab fa-hackerrank',
                'hover_icon' => '/images/menu/habboacademy.png'
            ];
        }

        if ($navigationLabel == 'Habbo') {
            return [
                'order' => 2,
                'small_icon' => 'fab fa-hire-a-helper',
                'hover_icon' => '/images/menu/habbo.png'
            ];
        }

        if ($navigationLabel == 'Conteúdos') {
            return [
                'order' => 3,
                'small_icon' => 'fab fa-neos',
                'hover_icon' => '/images/menu/conteudos.png'
            ];
        }

        if ($navigationLabel == 'Fã-Center') {
            return [
                'order' => 4,
                'small_icon' => 'fas fa-magic',
                'hover_icon' => '/images/menu/facenter.png'
            ];
        }

        if ($navigationLabel == 'Rádio') {
            return [
                'order' => 5,
                'small_icon' => 'fas fa-music',
                'hover_icon' => '/images/menu/radio.png'
            ];
        }
    }

    public function getDefaultNavigations()
    {
        return [
            'Início' => [],
            'HabboAcademy' => [
                'Sobre',
                'Equipe'
            ],
            'Habbo' => [
                'Acessar',
                'Equipe'
            ],
            'Conteúdos' => [],
            'Fã-Center' => [
                'Gerador de Avatar'
            ],
            'Rádio' => [
                'Horários',
                'Seja um locutor'
            ]
        ];
    }
}
