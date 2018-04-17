<?php

use App\Category;
use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Budget::class, function (Faker $faker) {
    return [
        'amount' => $faker->randomFloat(2, 500, 1000),
        'budget_date' => Carbon::now()->format('M'),
        'category_id' => function () {
            return createFactory(Category::class)->id;
        },
        'user_id' => function () {
            return createFactory(User::class)->id;
        }
    ];
});
