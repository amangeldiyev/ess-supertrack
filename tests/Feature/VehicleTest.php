<?php

namespace Tests\Feature;

use App\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Vehicle list showed on table.
     *
     * @return void
     */
    public function testShowVehicleList()
    {
        $this->loginUser();

        factory(Vehicle::class)->create();

        $vehicles = Vehicle::with('company')->get();

        $response = $this->get(route('vehicles.index'));

        $response->assertOk()
            ->assertViewHas('vehicles', $vehicles);
    }

    /**
     * Can create new vehicle
     *
     * @return void
     */
    public function testCreateVehicle()
    {
        $user = $this->loginUser();

        $response = $this->get(route('vehicles.create'));

        $response->assertOk();

        $vehicle = factory(Vehicle::class)->make();

        $response = $this->post(route('vehicles.store'), [
            'name' => $vehicle->name,
            'type' => $vehicle->type
        ]);

        $this->assertDatabaseHas('vehicles', [
            'name' => $vehicle->name,
            'company_id' => $user->company_id
        ]);

        $response->assertRedirect(route('vehicles.index'));
    }

    /**
     * Can edit vehicle data
     *
     * @return void
     */
    public function testEditVehicle()
    {
        $user = $this->loginUser();

        $vehicle = factory(Vehicle::class)->create(['company_id' => $user->company_id]);

        $response = $this->get(route('vehicles.edit', ['vehicle' => $vehicle->id]));

        $response->assertOk();

        $updatedVehicle = factory(Vehicle::class)->make();

        $response = $this->patch(route('vehicles.update', ['vehicle' => $vehicle]), [
            'name' => $updatedVehicle->name,
            'type' => $updatedVehicle->type
        ]);

        $this->assertDatabaseHas('vehicles', [
            'name' => $updatedVehicle->name,
            'type' => $updatedVehicle->type
        ])->assertDatabaseMissing('vehicles', [
            'name' => $vehicle->name,
            'type' => $vehicle->type
        ]);

        $response->assertRedirect(route('vehicles.index'));
    }

    /**
     * Can delete vehicle
     *
     * @return void
     */
    public function testDeleteVehicle()
    {
        $this->loginUser();

        $vehicle = factory(Vehicle::class)->create();

        $response = $this->delete(route('vehicles.destroy', ['vehicle' => $vehicle]));

        $this->assertDatabaseMissing('vehicles', $vehicle->toArray());

        $response->assertRedirect(route('vehicles.index'));
    }
}
