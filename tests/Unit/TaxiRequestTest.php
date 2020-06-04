<?php

namespace Tests\Unit;

use App\TaxiRequest;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaxiRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Sets status to 'assigned'
     * after driver and vehicle is assigned.
     *
     * @return void
     */
    public function testSetAssignedStatus()
    {
        $this->loginUser();

        $taxiRequest = factory(TaxiRequest::class)->create([
            'status' => 0,
            'driver_id' => null,
            'vehicle_id' => null,
        ]);

        $taxiRequest->update([
            'status' => 1,
            'driver_id' => 1,
            'vehicle_id' => 1,
        ]);

        $this->assertDatabaseHas('taxi_requests', [
            'id' => $taxiRequest->id,
            'status' => 2,
            'driver_id' => 1,
            'vehicle_id' => 1,
        ]);
    }

    /**
    * Shows remaining time in H:i format
    *
    * @return void
    */
    public function testRemainingTimeAttribute()
    {
        $this->loginUser();

        $taxiRequest = factory(TaxiRequest::class)->create([
            'start_date' => Carbon::now()->addMinutes(20)
        ]);

        $this->assertTrue($taxiRequest->remaining_time == '00:19');
    }

    /**
    * Replaces placeholders with texi-request data
    *
    * @return void
    */
    public function testSmsTextTemplate()
    {
        $this->loginUser();

        factory(TaxiRequest::class)->create();

        $taxiRequest = TaxiRequest::find(1);

        $text = $taxiRequest->sms_text($taxiRequest->company->confirm_sms_template['eng']);

        $this->assertStringContainsString($taxiRequest->id, $text);
        $this->assertStringContainsString($taxiRequest->start_date, $text);
        $this->assertStringContainsString($taxiRequest->vehicle->name, $text);
        $this->assertStringContainsString($taxiRequest->vehicle->type, $text);
        $this->assertStringContainsString($taxiRequest->driver->name, $text);
    }
}
