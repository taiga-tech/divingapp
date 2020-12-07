<?php

namespace Tests\Feature\Posts\Goods;

use App\Models\Post;
use App\Models\User;
use App\Models\Profile;
use App\Models\PostGood;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UnGoodApiTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->profile = Profile::factory()->create();
        $this->post = Post::factory()->create();
        $this->good = PostGood::factory()->create();
    }

    public function test_Good削除()
    {
        $response = $this
            ->actingAs($this->user)
            ->json('DELETE', route('goods.destroy', $this->good->id));

        $response
            ->assertStatus(200);
    }
}
