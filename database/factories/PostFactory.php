<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\Profile;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'title' => $faker->sentence(),
        'body' => $faker->paragraph(),
        'slug' => $faker->slug()
    ];
});

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'name' => $faker->name(),
    ];
});
