<?php

namespace Tests\Feature\Site;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_page_loading_well()
    {
        $response = $this->get(route('register'));
        $response->assertStatus(200);
    }
    public function test_register_users_returns_successfull_response()
    {
        $response = $this->post(route('register'), [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'password' => '123123123',
        ]);
        $response->assertRedirect('/home');
    }
    public function test_login_page_loading_well()
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
    }
    public function test_login_users_returns_successfull_response()
    {
        $user = User::factory()->create();
        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => '123123123',
        ]);
        $response->assertRedirect('/home');
    }
}
