<?php
// database/factories/FoodAttributeFactory.php

use App\Models\FoodAttribute;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

$factory->define(FoodAttribute::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'status' => $faker->randomElement([0, 1]), // Randomly choose between 0 and 1 (inactive or active)
    ];
});


