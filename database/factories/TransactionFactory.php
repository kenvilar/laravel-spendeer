<?php

use App\Category;
use \App\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence(2),
        'category_id' => function () {
            return factory(Category::class)->create()->id;
        }
    ];
});
