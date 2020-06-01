<?php

namespace Tests\Feature;

use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * User list showed on table.
     *
     * @return void
     */
    public function testShowUserList()
    {
        $this->loginAsAdmin();

        factory(User::class)->create();

        $users = User::with('company')->get();

        $response = $this->get(route('users.index'));

        $response->assertOk()
            ->assertViewHas('users', $users);
    }

    /**
     * Can create new user
     *
     * @return void
     */
    public function testCreateUser()
    {
        $this->loginAsAdmin();

        $response = $this->get(route('users.create'));

        $response->assertOk();

        $user = factory(User::class)->make();

        $response = $this->post(route('users.store'), [
            'name' => $user->name,
            'username' => $user->username,
            'email' => $user->email,
            'password' => 'Password#123',
            'company_id' => $user->company_id
        ]);

        $response->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', Arr::except($user->toArray(), ['password', 'email_verified_at']));
    }

    /**
     * Can edit user data
     *
     * @return void
     */
    public function testEditUser()
    {
        $this->loginAsAdmin();

        $user = factory(User::class)->create();

        $response = $this->get(route('users.edit', ['user' => $user]));

        $response->assertOk();

        $updatedUser = factory(User::class)->make();

        $response = $this->patch(route('users.update', ['user' => $user]), [
            'name' => $updatedUser->name,
            'username' => $updatedUser->username,
            'email' => $updatedUser->email,
            'password' => 'Password#123',
            'company_id' => $updatedUser->company_id
        ]);

        $response->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', Arr::except($updatedUser->toArray(), ['password', 'email_verified_at']))
            ->assertDatabaseMissing('users', Arr::except($user->toArray(), ['password', 'email_verified_at']));
    }

    /**
     * Can delete user
     *
     * @return void
     */
    public function testDeleteUser()
    {
        $this->loginAsAdmin();

        $user = factory(User::class)->create();

        $response = $this->delete(route('users.destroy', ['user' => $user]));

        $this->assertDatabaseMissing('users', $user->toArray());

        $response->assertRedirect(route('users.index'));
    }

    /**
     * Force password reset on first login
     * Force password reset after 30 days
     *
     * @return void
     */
    public function testResetPassword()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        // Force password reset on first login
        $this->get('/')->assertRedirect(route('password.expired'));

        // Force password reset after 30 days
        $changed_at = Carbon::now()->subDays(30);
        $user->password_changed_at = $changed_at;

        $this->get('/')->assertRedirect(route('password.expired'));

        $old_password = $user->password;

        $this->post(route('password.expired'), [
            'current_password' => 'password',
            'password' => 'Password#@123',
            'password_confirmation' => 'Password#@123'
        ])->assertRedirect(route('home'));

        $this->assertDatabaseHas('old_passwords', [ // user's old password saved to 'old_passwords' table
            'user_id' => $user->id,
            'hash' => $old_password
        ])->assertDatabaseMissing('users', [ // user password is no longer $old_password
            'id' => $user->id,
            'password' => $old_password
        ])->assertDatabaseMissing('users', [ // 'password_changed_at' is updated
            'id' => $user->id,
            'password_changed_at' => $changed_at
        ])->assertTrue(Hash::check('Password#@123', $user->password)); // new password saved for user
    }
}
