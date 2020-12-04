<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserApiTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_ログイン中のユーザーを返却()
    {
        $response = $this
            ->actingAs($this->user)
            ->json('GET', route('user'));

        $response
            ->assertStatus(200)
            ->assertJson([ 'userid' => $this->user->userid, ]);
    }

    public function test_ログインされていない場合は空文字を返却()
    {
        $response = $this->json('GET', route('user'));

        $response->assertStatus(200);
        $this->assertEquals("", $response->content());
    }
}
