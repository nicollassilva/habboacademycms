<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Article\ArticleCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrFail();
        $category = ArticleCategory::firstOrFail();

        Article::withoutEvents(function() use ($user, $category) {
            $user->articles()->create([
                'category_id' => $category->id,
                'title' => 'Bem-vindo à HabboAcademy!',
                'description' => 'HabboAcademy é uma CMS open-source para fã-sites Habbo.',
                'image_path' => 'https://habboassets.com/assets/images/web-promos/lpromo_h15generic2.png',
                'slug' => 'bem-vindo-a-habboacademy',
                'content' => '
                    <center>
                        <img class="d-block mb-4" src="https://1.bp.blogspot.com/-u9o-Bvx9lnQ/Vt5ENzbIcOI/AAAAAAAAkdw/-5teG4gKbk4/s1600/541661190.png" />
                        <span class="d-block">HabboAcademy instalada com sucesso! Obrigado pela preferência.</span>
                        <strong></> por Nicollas#8412</strong>
                    </center>
                ',
                'reviewed' => true,
                'reviewer' => $user->username,
                'status' => true,
                'fixed' => true
            ]);
        });
    }
}
