<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Card::class, function (Faker $faker) {
    $name = $faker->sentence(mt_rand(1,4));


    return [
        'name'        => $name,
        'name_rus'    => $name,
        'cmc'         => $faker->numberBetween(0, 20),
        'cost'        => '{3}{B}{U}',
        'description' => $faker->paragraph,
        'power'       => $faker->numberBetween(0, 10),
        'toughness'   => $faker->numberBetween(0, 10),
        'set_id'      => mt_rand(1,10),
        'rarity'      => $faker->randomElement(['*', '**', '***']),
        'flavor'      => $faker->paragraph,
        'image'       => $faker->imageUrl(233, 311),
        'artist'      => $faker->text(20),
        'color'       => $faker->randomElement(['W', 'B', 'U', 'G', 'R', 'M', null]),
        'deckbrew_id' => $faker->word
    ];
});
