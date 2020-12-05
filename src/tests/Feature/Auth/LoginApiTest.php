<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginApiTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_登録済みのユーザーを認証()
    {
        $response = $this
            ->json('POST', route('login'), [
                'email' => $this->user->email,
                'password' => 'password',
            ]);

        $response
            ->assertStatus(200)
            ->assertJson(['userid' => $this->user->userid]);

        $this->assertAuthenticatedAs($this->user);
    }
}
