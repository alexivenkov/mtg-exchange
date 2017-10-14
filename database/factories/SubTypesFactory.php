<?php

use Faker\Generator as Faker;

$factory->define(App\Models\SubType::class, function (Faker $faker) {
    $name = $faker->word;

    return [
        'name'     => $name,
        'name_rus' => $name
    ];
});
