<?php

namespace Tests;

use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Auth;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Login as admin
     *
     * @return void
     */
    protected function loginAsAdmin()
    {
        $admin = factory(User::class)->create([
            'username' => 'admin',
            'password_changed_at' => Carbon::now(),
            'company_id' => 0
        ]);

        $this->actingAs($admin);
    }

    /**
    * Login as operator user
    *
    * @return \App\User
    */
    public function loginUser()
    {
        $user = factory(User::class)->create([
            'password_changed_at' => Carbon::now()
        ]);

        $this->actingAs($user);

        return $user;
    }
}
