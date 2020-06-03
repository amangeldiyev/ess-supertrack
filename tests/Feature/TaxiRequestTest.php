<?php

namespace Tests\Feature;

use App\Events\TaxiRequestStatusChanged;
use App\TaxiRequest;
use App\User;
use Carbon\Carbon;
use Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

        $taxiRequest = factory(TaxiRequest::class)->make(['status' => 0]);

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

        $data['company_id'] = $user->company_id;

        $this->assertDatabaseHas('taxi_requests', $data);

        $response->assertOk()
            ->assertSeeInOrder($taxiRequest->pluck('passenger', 'phone', 'start_date')->toArray());
    }

    /**
     * Can edit taxi-request
     *
     * @return void
     */
    public function testEditTaxiRequest()
    {
        $user = factory(User::class)->create(['password_changed_at' => Carbon::now()]);

        $this->actingAs($user);

        $taxiRequest = factory(TaxiRequest::class)->create();

        $response = $this->getJson(route('taxi-requests.edit', ['taxi_request' => $taxiRequest]));

        $response->assertOk();

        $data = [
            'number' => $taxiRequest->number,
            'date' => date('d/m/Y', strtotime($taxiRequest->date)),
            'start_date' => "03/02/1990 20:43",
            'end_date' => $taxiRequest->end_date->format('d/m/Y H:i'),
            'status' => 2,
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

        $response = $this->patchJson(route('taxi-requests.update', ['taxi_request' => $taxiRequest]), $data);

        $this->assertDatabaseMissing('taxi_requests', ['start_date' => $taxiRequest->start_date])
            ->assertDatabaseHas('taxi_requests', ['start_date' => "03/02/1990 20:43"]);

        $response->assertOk();
    }

    /**
     * Can update taxi-request status
     * 
     * @return void
     */
    public function testUpdateStatus()
    {
        $user = factory(User::class)->create(['password_changed_at' => Carbon::now()]);

        $this->actingAs($user);

        $taxiRequest = factory(TaxiRequest::class)->create(['status' => 0]);

        $response = $this->getJson(route('taxi-requests.update-status', ['taxiRequest' => $taxiRequest, 'status' => 1]));

        $response->assertOk();

        Event::fake();

        $response = $this->putJson(route('taxi-requests.update-status', ['taxiRequest' => $taxiRequest, 'status' => 1]), [
            'sms_notification' => false,
            'email_notification' => true,
        ]);

        Event::assertDispatched(TaxiRequestStatusChanged::class);

        $this->assertDatabaseHas('taxi_requests', [
            'id' => $taxiRequest->id,
            'status' => 1
        ]);

        $response->assertOk();
    }
}
