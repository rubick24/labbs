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
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        //'password' => $password ?: $password = bcrypt('secret'),
        'password' => 'qqqqqq',
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Tag::class,function (Faker\Generator $faker){
    return [
        'name' => $faker->word,
    ];
});

$factory->define(App\Category::class,function (Faker\Generator $faker){
    return [
        'name' => $faker->word,
    ];
});

$factory->define(App\Article::class,function (Faker\Generator $faker){
    return [
        'user_id'     => $faker->numberBetween(1,6),
        'category_id' => $faker->numberBetween(1,4),
        'title'       => $faker->sentence(),
        'url'         => 'article/markdown.md',
        'stat'        => 0,
        'upper'       => false
    ];
});

$factory->define(App\Comment::class,function (Faker\Generator $faker){
    return [
        'article_id'  => $faker->numberBetween(1,20),
        'user_id'     => $faker->numberBetween(1,6),
        'content'     => $faker->sentences(3,true),
    ];
});