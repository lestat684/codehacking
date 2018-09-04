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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt('secret'),
        'remember_token' => str_random(10),
        'role_id' =>$faker->numberBetween(1, 3),
        'is_active' => 1,
        'photo_id' => 1,
    ];
});

$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->randomElement(['admin', 'author', 'subscriber'])
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->randomElement(['news', 'business', 'sport'])
    ];
});


$factory->define(App\Photo::class, function (Faker\Generator $faker) {
    return [
        'file' => 'placeholder.jpg'
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'post_id' => $faker->numberBetween(1, 10),
        'is_active' => $faker->boolean(),
        'author' => $faker->name(),
        'body' => $faker->paragraph(5, true)
    ];
});

$factory->define(App\CommentReply::class, function (Faker\Generator $faker) {
    return [
        'comment_id' => $faker->numberBetween(1, 10),
        'is_active' => $faker->boolean(),
        'author' => $faker->name,
        'body' => $faker->paragraph(5, true)
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 10),
        'category_id' => $faker->numberBetween(1, 4),
        'photo_id' => 1,
        'title' => $faker->sentence(7, 11),
        'body' =>$faker->paragraph(rand(10, 20), true),
        'slug' => $faker->slug(),
    ];
});
