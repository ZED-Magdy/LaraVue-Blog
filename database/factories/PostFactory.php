<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Image;
use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => rand(1,10),
        'category_id' => rand(1,10),
        'title' => $faker->sentence(),
        'body' => $faker->paragraph(),
        'slug' => $faker->slug()
    ];
});

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
    ];
});

$factory->define(Image::class, function(Faker $faker){
    return [
        'url' => $faker->imageUrl(),
        'user_id' => rand(1,10),
        'imageable_type' => 'App\\User',
        'imageable_id' => rand(1,10)
    ];
});
