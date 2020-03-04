<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use App\Driver;
use App\Passenger;
use App\TaxiRequest;
use App\Vehicle;
use Faker\Generator as Faker;

$factory->define(TaxiRequest::class, function (Faker $faker) {
    return [
        'number' => $faker->randomDigit(4),
        'date' => $faker->date(),
        'start_date' => $faker->dateTime(),
        'end_date' => $faker->dateTime(),
        'status' => $faker->randomElement([0, 1, 2, 3, 4]),
        'type' => $faker->randomElement([0, 1]),
        'passenger_type' => $faker->randomElement([0, 1]),
        'qty' => $faker->randomDigit,
        'driver_in_time' => $faker->randomElement([0, 1]),
        'company_id' => factory(Company::class)->create()->id,
        'passenger' => $faker->name,
        'phone' => $faker->phoneNumber,
        'pick_up_location' => $faker->sentence(3),
        'drop_off_location' => $faker->sentence(3),
        'on_location_time' => $faker->dateTime(),
        'pick_up_time' => $faker->dateTime(),
        'drop_off_time' => $faker->dateTime(),
        'driver_id' => factory(Driver::class)->create()->id,
        'vehicle_id' => $vehicle_id = factory(Vehicle::class)->create()->id,
        'vehicle_type' => Vehicle::find($vehicle_id)->type,
        'comment' => $faker->sentence(5),
        'ordered_by' => factory(Passenger::class)->create()->id,
    ];
});
