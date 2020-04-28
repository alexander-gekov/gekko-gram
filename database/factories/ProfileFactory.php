<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    $faker->addProvider(new \Mmo\Faker\PicsumProvider($faker));
    return [
        'user_id' => rand(1,30),
        'title' => $faker->name,
        'description' => $faker->sentence(),
        'image' => $faker->picsumUrl(400, 400),
    ];
});
