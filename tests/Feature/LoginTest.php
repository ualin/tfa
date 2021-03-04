<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_half_authenticated_user_cannot_access_home_page()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->get('/home')->assertRedirect('/login');
    }
}
