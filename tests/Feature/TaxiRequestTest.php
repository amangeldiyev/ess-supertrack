<?php

namespace Tests\Feature;

use App\TaxiRequest;
use App\User;
use Arr;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaxiRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * TaxiRequest list showed on table.
     *
     * @return void
     */
    public function testShowTaxiRequestList()
    {
        $this->actingAs(factory(User::class)->create(['password_changed_at' => Carbon::now()]));

        factory(TaxiRequest::class)->create();

        $response = $this->get(route('taxi-requests.index'));

        $response->assertOk()
            ->assertViewHas('taxiRequests');
    }

    /**
     * Can create new taxi-request
     *
     * @return void
     */
    public function testCreateTaxiRequest()
    {
        $user = factory(User::class)->create(['password_changed_at' => Carbon::now()]);

        $this->actingAs($user);

        $response = $this->get(route('taxi-requests.create'));

        $response->assertOk();

        $taxiRequest = factory(TaxiRequest::class)->make();

        $data = [
            'number' => $taxiRequest->number,
            'date' => date('d/m/Y', strtotime($taxiRequest->date)),
            'start_date' => "03/02/1990 20:43",
            'end_date' => $taxiRequest->end_date->format('d/m/Y H:i'),
            'status' => $taxiRequest->status,
            'type' => $taxiRequest->type,
            'passenger_type' => $taxiRequest->passenger_type,
            'qty' => $taxiRequest->qty,
            'driver_in_time' => $taxiRequest->driver_in_time,
            'company_id' => $taxiRequest->company_id,
            'passenger' => $taxiRequest->passenger,
            'phone' => $taxiRequest->phone,
            'pick_up_location' => $taxiRequest->pick_up_location,
            'drop_off_location' => $taxiRequest->drop_off_location,
            'on_location_time' => date('H:i', strtotime($taxiRequest->on_location_time)),
            'pick_up_time' => date('H:i', strtotime($taxiRequest->pick_up_time)),
            'drop_off_time' => date('H:i', strtotime($taxiRequest->drop_off_time)),
            'driver_id' => $taxiRequest->driver_id,
            'vehicle_id' => $taxiRequest->vehicle_id,
            'vehicle_type' => $taxiRequest->vehicle_type,
            'comment' => $taxiRequest->comment,
            'ordered_by' => $taxiRequest->ordered_by,
        ];

        $response = $this->postJson(route('taxi-requests.store'), $data);

        $this->assertDatabaseHas('taxi_requests', $data);

        $response->assertOk()
            ->assertSeeInOrder($taxiRequest->pluck('passenger', 'phone', 'start_date')->toArray());
    }
}
