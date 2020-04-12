<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ForumCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];

        $cName = 'Без Названия';
        $categories[] = [
            'title' => $cName,
            'slug' => str_slug($cName),
            'parent_id' => 0,
        ];

        for ($i = 0; $i <= 12; $i++) {
            $cName = 'Категория №'.$i;
            $parentId = ($i > 4) ? rand(1, 4) : 1;
            $categories[] = [
                'title' => $cName,
                'slug' => str_slug($cName),
                'parent_id' => $parentId,
            ];
        }
        DB::table('forum_categories')->insert($categories);
    }
}
