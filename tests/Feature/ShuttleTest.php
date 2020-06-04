<?php

namespace Tests\Feature;

use App\Shuttle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShuttleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Shuttle list showed on table.
     *
     * @return void
     */
    public function testShowShuttleList()
    {
        $this->loginUser();

        factory(Shuttle::class)->create();

        $shuttles = Shuttle::all();

        $this->get(route('shuttles.index'))
            ->assertOk()
            ->assertViewHas('shuttles', $shuttles);
    }

    /**
     * Can create new shuttle
     *
     * @return void
     */
    public function testCreateShuttle()
    {
        $this->loginUser();

        $response = $this->get(route('shuttles.create'));

        $response->assertOk();

        $shuttle = factory(Shuttle::class)->make();

        $response = $this->post(route('shuttles.store'), [
            'name' => $shuttle->name,
            'route' => $shuttle->route,
        ]);

        $this->assertDatabaseHas('shuttles', [
            'name' => $shuttle->name,
            'route' => json_encode($shuttle->route),
        ]);

        $response->assertRedirect(route('shuttles.index'));
    }

    /**
     * Can edit shuttle
     *
     * @return void
     */
    public function testEditShuttle()
    {
        $this->loginUser();

        $shuttle = factory(Shuttle::class)->create();

        $response = $this->get(route('shuttles.edit', ['shuttle' => $shuttle->id]));

        $response->assertOk();

        $updatedShuttle = factory(Shuttle::class)->make();

        $response = $this->patch(route('shuttles.update', ['shuttle' => $shuttle]), [
            'name' => $updatedShuttle->name,
            'route' => $updatedShuttle->route
        ]);

        $this->assertDatabaseHas('shuttles', [
            'name' => $updatedShuttle->name,
            'route' => json_encode($updatedShuttle->route)
        ])->assertDatabaseMissing('shuttles', [
            'name' => $shuttle->name
        ]);

        $response->assertRedirect(route('shuttles.index'));
    }

    /**
     * Can delete shuttle
     *
     * @return void
     */
    public function testDeleteShuttle()
    {
        $this->loginUser();

        $shuttle = factory(Shuttle::class)->create();

        $response = $this->delete(route('shuttles.destroy', ['shuttle' => $shuttle]));

        $this->assertDatabaseMissing('shuttles', [
            'name' => $shuttle->name,
            'route' => json_encode($shuttle->route)
        ]);

        $response->assertRedirect(route('shuttles.index'));
    }
}
