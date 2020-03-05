<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use App\Vehicle;
use Faker\Generator as Faker;

$factory->define(Vehicle::class, function (Faker $faker) {
    return [
        'name' => $faker->randomNumber(6),
        'type' => $faker->word(),
        'company_id' => factory(Company::class)
    ];
});
