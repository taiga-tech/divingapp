<?php

namespace Tests\Feature\Posts\Goods;

use App\Models\Post;
use App\Models\User;
use App\Models\Profile;
use App\Models\PostGood;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GoodApiTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->profile = Profile::factory()->create();
        $this->post = Post::factory()->create();
    }

    public function test_Good()
    {
        $response = $this
            ->actingAs($this->user)
            ->json('POST', route('goods.store'), $data = [
                'boolean' => true,
                'post_id' => $this->post->id,
                'user_id' => $this->user->id,
            ]);

        $good = PostGood::first();
        $this->assertEquals($data['boolean'], $good->boolean);

        $response
            ->assertStatus(201)
            ->assertJson(['boolean' => $good->boolean]);
    }
}
