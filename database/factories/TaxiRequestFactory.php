<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use App\Driver;
use App\Passenger;
use App\TaxiRequest;
use App\Vehicle;
use Faker\Generator as Faker;

$factory->define(TaxiRequest::class, function (Faker $faker) {
    $company = Company::inRandomOrder()->first();

    return [
        'number' => $faker->randomDigitNot(0),
        'date' => $faker->date(),
        'start_date' => $faker->dateTime(),
        'end_date' => $faker->dateTime(),
        'status' => $faker->randomElement([0, 1, 2, 3, 4]),
        'type' => $faker->randomElement([0, 1]),
        'passenger_type' => $faker->randomElement([0, 1]),
        'qty' => $faker->randomDigitNot(0),
        'driver_in_time' => $faker->randomElement([0, 1]),
        'company_id' => $company->id,
        'passenger' => $faker->name,
        'phone' => $faker->phoneNumber,
        'pick_up_location' => $faker->sentence(3),
        'drop_off_location' => $faker->sentence(3),
        'on_location_time' => $faker->time(),
        'pick_up_time' => $faker->time(),
        'drop_off_time' => $faker->time(),
        'driver_id' => factory(Driver::class)->create(['company_id' => $company->id])->id,
        'vehicle_id' => $vehicle_id = factory(Vehicle::class)->create(['company_id' => $company->id])->id,
        'vehicle_type' => Vehicle::find($vehicle_id)->type,
        'comment' => $faker->sentence(5),
        'ordered_by' => factory(Passenger::class)->create(['company_id' => $company->id]),
    ];
});
