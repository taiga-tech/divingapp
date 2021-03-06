<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogoutApiTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_認証済みユーザーをログアウト()
    {
        $response = $this
            ->actingAs($this->user)
            ->json('POST', route('logout'));

        $response->assertStatus(200);
        $this->assertGuest();
    }
}
