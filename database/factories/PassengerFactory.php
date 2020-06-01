<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use App\Passenger;
use Faker\Generator as Faker;

$factory->define(Passenger::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'badge_number' => $faker->unique()->randomNumber(8),
        'phone' => $faker->e164PhoneNumber,
        'email' => $faker->email,
        'lang' => 0,
        'sms_notification' => 0,
        'email_notification' => 1,
        'company_id' => factory(Company::class)
    ];
});
