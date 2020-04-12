<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ForumPost;
use Faker\Generator as Faker;

$factory->define(\App\Models\ForumPost::class, function (Faker $faker) {
    $title = $faker->sentence(rand(3, 8), true);
    $txt = $faker->realText(rand(1000, 4000));
    $is_published = rand(1, 5) > 1;
    $craeted_at = $faker->dateTimeBetween('-3 months', '-2 days');

    $data = [
        'category_id' => rand(2, 11),
        'user_id' => $faker->randomElement([1,2]),
        'title' => $title,
        'slug' => str_slug($title),
        'excerpt' => $faker->text(rand(40, 100)),
        'content_row' => $txt,
        'content_html' => $txt,
        'is_published' => $is_published,
        'published_at' => $is_published ? $faker->dateTimeBetween('-2 months', '-1 days') : null,
        'created_at' => $craeted_at,
        'updated_at' => $craeted_at,
    ];

    return $data;
});
