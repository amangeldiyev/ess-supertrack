<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'confirm_sms_template' => null,
        'assign_sms_template' => null,
        'cancel_sms_template' => null,
        'on_location_sms_template' => null
    ];
});
