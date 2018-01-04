<?php

use Faker\Generator as Faker;

$factory->define(App\GroceryList::class, function (Faker $faker) {
    return [
  	    'product_id' => function () {
  			    return factory(App\Product::class)->create()->id;
  		  },
        'price' => $faker->randomNumber,
  		  'quantity' => $faker->numberBetween($min = 1, $max = 1000),
    ];
});
