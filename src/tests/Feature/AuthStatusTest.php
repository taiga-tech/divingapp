<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthStatusTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testGetRegisterStatus()
    {
        $response = $this->get(route('register'))
            ->assertStatus(200);
    }

    public function testPostRegisterStatus()
    {
        $user = User::factory()->make();

        $response = $this->followingRedirects()
            ->post(route('register'), [$user])
            ->assertStatus(200);
    }

    public function testGetLoginStatus()
    {
        $response = $this->get(route('login'))
            ->assertStatus(200);
    }

    public function testPostLoginStatus()
    {
        $user = User::factory()->create();

        $response = $this->followingRedirects()
            ->post(route('login'), [$user])
            ->assertStatus(200);
    }

}
