<?php

namespace Tests\Feature\Search;

use App\Models\Post;
use App\Models\PostImage;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class SearchApiTest extends TestCase
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

    public function test_Postの検索()
    {
        $response = $this->json('GET', '/api/search/post?text=test');

        $this->assertCount(5, $response->json());
        $response->assertStatus(200);
    }

    public function test_Placeの検索()
    {
        $response = $this->json('GET', '/api/search/post?place=福岡');

        $this->assertCount(5, $response->json());
        $response->assertStatus(200);
    }

    public function test_Profileの検索() {
        $response = $this->json('GET', '/api/search/profile?name=test');

        $this->assertCount(1, $response->json());
        $response->assertStatus(200);
    }
}
