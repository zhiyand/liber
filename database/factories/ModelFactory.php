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

$factory->define(App\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'role' => $faker->randomElement(['user', 'librarian', 'administrator']),
        'birthday' => $faker->dateTimeBetween('-30 years', 'now'),
        'password' => str_random(10),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Book::class, function ($faker) {
    return [
        'title' => $faker->sentence,
        'author' => $faker->name,
        'isbn' => $faker->isbn13,
        'quantity' => $faker->numberBetween(1, 10),
        'shelf' => '#' . $faker->word,
        'description' => $faker->paragraph,
        'cover' => $faker->imageUrl(400, 300),
    ];
});

$factory->define(App\Loan::class, function ($faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'book_id' => factory(App\Book::class)->create()->id,
        'status' => 'active',
        'expiry' => $faker->dateTimeBetween('-1 years', '+1 years'),
        'returned_at' => $faker->dateTimeBetween('-1 years', '+1 years'),
    ];
});
