<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
$factory->define(App\Models\Book::class, function (Faker\Generator $faker) {
    return [
        'author_id' => $faker->numberBetween(1, 50),
        'title' => $faker->sentence(2, true),
        'description' => $faker->sentence(6, true),
        'price' => $faker->numberBetween(50, 250),
    ];
});
