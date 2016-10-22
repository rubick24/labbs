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
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('password'),
        'token' => str_random(),
        'status' => 1,
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
    $user_ids = \App\User::pluck('id')->toArray();
    $category_ids = \App\Category::pluck('id')->toArray();
    return [
        'user_id'     => $faker->randomElement($user_ids),
        'category_id' => $faker->randomElement($category_ids),
        'title'       => $faker->sentence(),
        'url'         => 'public/article/markdown.md',
        'stat'        => 0,
        'upper'       => false
    ];
});

$factory->define(App\Comment::class,function (Faker\Generator $faker){
    $article_ids = \App\Article::pluck('id')->toArray();
    $user_ids = \App\User::pluck('id')->toArray();
    return [
        'article_id'  => $faker->randomElement($article_ids),
        'user_id'     => $faker->randomElement($user_ids),
        'content'     => $faker->sentences(3,true),
    ];
});

$factory->define(App\Message::class,function (Faker\Generator $faker){
    $user_ids = \App\User::pluck('id')->toArray();
    return [
        'user_id'     => $faker->randomElement($user_ids),
        'sender_id'  => $faker->randomElement($user_ids),
        'content'     => $faker->sentences(3,true),
    ];
});