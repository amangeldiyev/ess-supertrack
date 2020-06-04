<?php

namespace Tests\Feature;

use App\Driver;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DriverTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Driver list showed on table.
     *
     * @return void
     */
    public function testShowDriverList()
    {
        $this->loginUser();

        factory(Driver::class)->create();

        $drivers = Driver::with('company')->get();

        $response = $this->get(route('drivers.index'));

        $response->assertOk()
            ->assertViewHas('drivers', $drivers);
    }

    /**
     * Can create new driver
     *
     * @return void
     */
    public function testCreateDriver()
    {
        $user = $this->loginUser();

        $response = $this->get(route('drivers.create'));

        $response->assertOk();

        $driver = factory(Driver::class)->make();

        $response = $this->post(route('drivers.store'), [
            'name' => $driver->name,
        ]);

        $this->assertDatabaseHas('drivers', [
            'name' => $driver->name,
            'company_id' => $user->company_id
        ]);

        $response->assertRedirect(route('drivers.index'));
    }

    /**
     * Can edit driver data
     *
     * @return void
     */
    public function testEditDriver()
    {
        $user = $this->loginUser();

        $driver = factory(Driver::class)->create(['company_id' => $user->company_id]);

        $response = $this->get(route('drivers.edit', ['driver' => $driver->id]));

        $response->assertOk();

        $updatedDriver = factory(Driver::class)->make();

        $response = $this->patch(route('drivers.update', ['driver' => $driver]), [
            'name' => $updatedDriver->name,
        ]);

        $this->assertDatabaseHas('drivers', [
            'name' => $updatedDriver->name
        ])->assertDatabaseMissing('drivers', [
            'name' => $driver->name
        ]);

        $response->assertRedirect(route('drivers.index'));
    }

    /**
     * Can delete driver
     *
     * @return void
     */
    public function testDeleteDriver()
    {
        $this->loginUser();

        $driver = factory(Driver::class)->create();

        $response = $this->delete(route('drivers.destroy', ['driver' => $driver]));

        $this->assertDatabaseMissing('drivers', $driver->toArray());

        $response->assertRedirect(route('drivers.index'));
    }
}
