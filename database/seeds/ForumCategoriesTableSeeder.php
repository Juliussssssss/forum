<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Generator as Faker;

class ForumCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker)
    {
        $categories = [];

        $cName = 'Без Названия';
        $categories[] = [
            'title' => $cName,
            'slug' => str_slug($cName),
            'parent_id' => 0,
            'created_at' => \Carbon\Carbon::now(),
            'description' => $faker->realText(rand(10, 50))
        ];

        for ($i = 0; $i <= 12; $i++) {
            $cName = 'Категория №'.$i;
            $parentId = ($i > 4) ? rand(1, 4) : 1;
            $categories[] = [
                'title' => $cName,
                'slug' => str_slug($cName),
                'parent_id' => $parentId,
                'created_at' => \Carbon\Carbon::now(),
                'description' => $faker->realText(rand(10, 50))
            ];
        }
        DB::table('forum_categories')->insert($categories);
    }
}
