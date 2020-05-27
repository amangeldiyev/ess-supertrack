<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * User can log in.
     *
     * @return void
     */
    public function testLogin()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);

        $user = factory(User::class)->create(['username' => 'user']);

        $response = $this->post('/login', [
            'username' => 'user',
            'password' => 'password'
        ]);
        
        $response->assertRedirect(route('home'));
        
        $this->assertAuthenticatedAs($user);
    }
}
