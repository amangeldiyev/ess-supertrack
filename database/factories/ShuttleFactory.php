<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shuttle;
use Faker\Generator as Faker;

$factory->define(Shuttle::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'route' => [
            'start' => [
                'address' => $faker->sentence(3),
                'time' => '8:30'
            ],
            'end' => [
                'address' => $faker->sentence(3),
                'time' => '8:45'
            ]
        ],
        'map' => '',
    ];
});
