<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Set::class, function (Faker $faker) {
    $name = $faker->sentence(mt_rand(1,2));

    return [
        'name'        => $name,
        'name_rus'    => $name,
        'deckbrew_id' => str_random(10),
    ];
});
