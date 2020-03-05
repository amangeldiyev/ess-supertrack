<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use App\Driver;
use Faker\Generator as Faker;

$factory->define(Driver::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'company_id' => factory(Company::class)
    ];
});
