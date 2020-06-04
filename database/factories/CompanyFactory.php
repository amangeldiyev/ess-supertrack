<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'confirm_sms_template' => [
            'eng' => 'Taxi Request confirmed [start_date] [driver] [vehicle] [type] [id]',
            'ru' => 'Taxi Request confirmed [start_date] [driver] [vehicle] [type] [id]',
            'kz' => 'Taxi Request confirmed [start_date] [driver] [vehicle] [type] [id]',
        ],
        'assign_sms_template' => [
            'eng' => 'Taxi Request assigned [start_date] [driver] [vehicle] [type] [id]',
            'ru' => 'Taxi Request assigned [start_date] [driver] [vehicle] [type] [id]',
            'kz' => 'Taxi Request assigned [start_date] [driver] [vehicle] [type] [id]',
        ],
        'cancel_sms_template' => [
            'eng' => 'Taxi Request cancelled [start_date] [driver] [vehicle] [type] [id]',
            'ru' => 'Taxi Request cancelled [start_date] [driver] [vehicle] [type] [id]',
            'kz' => 'Taxi Request cancelled [start_date] [driver] [vehicle] [type] [id]',
        ],
        'on_location_sms_template' => [
            'eng' => 'Taxi on location [start_date] [driver] [vehicle] [type] [id]',
            'ru' => 'Taxi on location [start_date] [driver] [vehicle] [type] [id]',
            'kz' => 'Taxi on location [start_date] [driver] [vehicle] [type] [id]',
        ]
    ];
});
