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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Admin::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('123'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->randomElement([
            'drama',
            'action', 
            'love', 
            'detective', 
            'history', 
            'cartoon',
            'children',
            'war',
            'military',
        ]),
        'description' => $faker->realText(50),
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->realText(50),
        'year' => $faker->year,
        'make' => $faker->company,
        'duration' => $faker->randomNumber(4),
    ];
});

$factory->define(App\Movie::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->realText(50),
        'order' => 0,
        'watched' => $faker->randomNumber(3),
        'duration' => $faker->randomNumber(4),
        'year' => $faker->year,
        'make' => $faker->company,
    ];
});

$factory->define(App\Series::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->realText(50),
        'duration' => $faker->randomNumber(4),
        'year' => $faker->year,
        'make' => $faker->company,
    ];
});

$factory->define(App\Image::class, function (Faker\Generator $faker) {
    $storage_url = Storage::disk('public')->getConfig()->get('url');

    return [
        'url' => $storage_url . '/images/' . ($faker->randomDigit % 10) . '.jpg',
    ];
});

$factory->define(App\Play::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'duration' => $faker->randomNumber(3),
    ];
});

$factory->define(App\Video::class, function (Faker\Generator $faker) {
    $storage_url = Storage::disk('public')->getConfig()->get('url');

    return [
        'name' => $faker->name,
        'url' => $storage_url . '/videos/' . ($faker->randomDigit % 10) . '.mp4',
        'duration' => $faker->randomNumber(3),
        'quality' => $faker->randomElement(App\Play::RESOLUTION_OPTIONS)
    ];
});

$factory->define(App\Subtitle::class, function (Faker\Generator $faker) {
    $storage_url = Storage::disk('public')->getConfig()->get('url');

    return [
        'language' => $faker->languageCode,
        'url' => $storage_url . '/subtitles/' . ($faker->randomDigit % 10) . '.txt',
    ];
});

$factory->define(App\Review::class, function (Faker\Generator $faker) {
    return [
        'score' => $faker->randomDigit % 10,
        'approved' => 1,
        'description' => $faker->realText(50),
    ];
});

$factory->define(App\Cast::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(App\Actor::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'gender' => 0,
        'age' => 30,
    ];
});
