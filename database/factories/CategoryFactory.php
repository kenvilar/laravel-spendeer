<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    $name = $faker->word;
    return [
        'name' => $name,
        'slug' => str_slug($name),
        'user_id' => function () {
            return createFactory(User::class)->id;
        }
    ];
});
