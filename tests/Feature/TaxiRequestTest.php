<?php

namespace Tests\Feature;

use App\TaxiRequest;
use App\User;
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
     * Incomplete test!!!
     * 
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

        $response = $this->postJson(route('taxi-requests.store'), $taxiRequest->toArray());
    }
}
