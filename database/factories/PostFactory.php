<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $faker->addProvider(new \Mmo\Faker\PicsumProvider($faker));
    return [
        'image' => $faker->picsumUrl(1200, 1200),
        'caption' => $faker->sentence(),
        'user_id' => rand(1,31),
    ];
});
