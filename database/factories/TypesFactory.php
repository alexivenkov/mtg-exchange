<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Type::class, function (Faker $faker) {
    $name = $faker->word;

    return [
        'name'     => $name,
        'name_rus' => $name
    ];
});
