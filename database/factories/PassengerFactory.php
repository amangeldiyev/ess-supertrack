<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use App\Passenger;
use Faker\Generator as Faker;

$factory->define(Passenger::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'badge_number' => $faker->randomNumber(8),
        'phone' => $faker->phoneNumber,
        'email' => $faker->email,
        'company_id' => factory(Company::class)
    ];
});
