<?php

namespace Tests\Feature\Posts;

use App\Models\Post;
use App\Models\PostImage;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;


class PostIndexApiTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->profile = Profile::factory()->create();
        $this->post = Post::factory(5)->create();
    }

    public function test_投稿一覧()
    {
        $response = $this
            ->json('GET', route('posts.index'));

        $this->assertCount(5, $response->json());

        $response->assertStatus(200);
    }
}
