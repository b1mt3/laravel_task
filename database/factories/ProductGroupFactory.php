<?php

use Faker\Generator as Faker;

$factory->define(App\ProductGroup::class, function (Faker $faker) {
    return [
        'group_name' => $faker->word,
    ];
});
