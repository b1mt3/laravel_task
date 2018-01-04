<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'product_name' => $faker->word,
        'group_id'=> function () {
			  return factory(App\ProductGroup::class)->create()->id;
		}
    ];
});
