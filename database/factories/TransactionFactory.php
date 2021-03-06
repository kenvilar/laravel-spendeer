<?php

use App\Category;
use App\Transaction;
use App\User;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence(2),
        'amount' => $faker->numberBetween(5, 10),
        'category_id' => function () {
            return createFactory(Category::class)->id;
        },
        'user_id' => function () {
            return createFactory(User::class)->id;
        }
    ];
});
