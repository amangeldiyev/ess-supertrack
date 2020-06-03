<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'confirm_sms_template' => [
            'eng' => 'Taxi Request confirmed',
            'ru' => 'Taxi Request confirmed',
            'kz' => 'Taxi Request confirmed',
        ],
        'assign_sms_template' => [
            'eng' => 'Taxi Request assigned',
            'ru' => 'Taxi Request assigned',
            'kz' => 'Taxi Request assigned',
        ],
        'cancel_sms_template' => [
            'eng' => 'Taxi Request cancelled',
            'ru' => 'Taxi Request cancelled',
            'kz' => 'Taxi Request cancelled',
        ],
        'on_location_sms_template' => [
            'eng' => 'Taxi on location',
            'ru' => 'Taxi on location',
            'kz' => 'Taxi on location',
        ]
    ];
});
