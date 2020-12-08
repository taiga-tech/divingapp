<?php

namespace Tests\Feature\Profiles;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileCreateApiTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_新規ユーザ作成のプロフィール作成()
    {
        $response = $this
            ->actingAs($this->user)
            ->json('POST', route('profiles.store'), $data = [
                'name' => $this->user->userid,
                'image' => '/default.png',
            ]);

        $profile = Profile::first();
        $this->assertEquals($data['name'], $profile->name);

        $response
            ->assertStatus(201)
            ->assertJson(['name' => $profile->name]);
    }
}
