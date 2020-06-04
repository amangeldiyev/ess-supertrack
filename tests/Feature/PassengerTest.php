<?php

namespace Tests\Feature;

use App\Passenger;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PassengerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Passenger list showed on table.
     *
     * @return void
     */
    public function testShowPassengerList()
    {
        $this->loginUser();

        factory(Passenger::class)->create();

        $response = $this->get(route('passengers.index'));

        $response->assertOk()
            ->assertViewHas('passengers');
    }

    /**
     * Can create new passenger
     *
     * @return void
     */
    public function testCreatePassenger()
    {
        $user = $this->loginUser();

        $response = $this->get(route('passengers.create'));

        $response->assertOk();

        $passenger = factory(Passenger::class)->make();

        $response = $this->post(route('passengers.store'), [
            'name' => $passenger->name,
            'badge_number' => $passenger->badge_number,
            'phone' => $passenger->phone,
            'email' => $passenger->email,
            'lang' => $passenger->getAttributes()['lang'],
            'sms_notification' => $passenger->sms_notification,
            'email_notification' => $passenger->email_notification,
        ]);

        $this->assertDatabaseHas('passengers', [
            'name' => $passenger->name,
            'badge_number' => $passenger->badge_number,
            'phone' => $passenger->phone,
            'email' => $passenger->email,
            'lang' => $passenger->getAttributes()['lang'],
            'sms_notification' => $passenger->sms_notification,
            'email_notification' => $passenger->email_notification,
            'company_id' => $user->company_id
        ]);

        $response->assertRedirect(route('passengers.index'));
    }

    /**
     * Can edit passenger data
     *
     * @return void
     */
    public function testEditPassenger()
    {
        $user = $this->loginUser();

        $passenger = factory(Passenger::class)->create(['company_id' => $user->company_id]);

        $response = $this->get(route('passengers.edit', ['passenger' => $passenger->id]));

        $response->assertOk();

        $updatedPassenger = factory(Passenger::class)->make();

        $response = $this->patch(route('passengers.update', ['passenger' => $passenger]), [
            'name' => $updatedPassenger->name,
            'badge_number' => $updatedPassenger->badge_number,
            'phone' => $updatedPassenger->phone,
            'email' => $updatedPassenger->email,
            'lang' => $updatedPassenger->getAttributes()['lang'],
            'sms_notification' => $updatedPassenger->sms_notification,
            'email_notification' => $updatedPassenger->email_notification,
        ]);

        $this->assertDatabaseHas('passengers', [
            'name' => $updatedPassenger->name,
            'badge_number' => $updatedPassenger->badge_number,
            'phone' => $updatedPassenger->phone,
            'email' => $updatedPassenger->email,
            'lang' => $updatedPassenger->getAttributes()['lang'],
            'sms_notification' => $updatedPassenger->sms_notification,
            'email_notification' => $updatedPassenger->email_notification,
        ])->assertDatabaseMissing('passengers', [
            'name' => $passenger->name,
            'badge_number' => $passenger->badge_number,
            'phone' => $passenger->phone,
            'email' => $passenger->email,
            'lang' => $passenger->getAttributes()['lang'],
            'sms_notification' => $passenger->sms_notification,
            'email_notification' => $passenger->email_notification,
        ]);

        $response->assertRedirect(route('passengers.index'));
    }

    /**
     * Can delete passenger
     *
     * @return void
     */
    public function testDeletePassenger()
    {
        $this->loginUser();

        $passenger = factory(Passenger::class)->create();

        $response = $this->delete(route('passengers.destroy', ['passenger' => $passenger]));

        $this->assertDatabaseMissing('passengers', $passenger->toArray());

        $response->assertRedirect(route('passengers.index'));
    }

    /**
     * Search passengers
     *
     * @return void
     */
    public function testPassengerSearch()
    {
        $this->loginUser();

        $passenger = factory(Passenger::class)->create(['name' => 'John Doe']);

        $response = $this->get(route('passengers.search', ['q' => 'john']));

        $response->assertOk()
            ->assertJson([
                $passenger->toArray()
            ]);
    }
}
