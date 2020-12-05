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

class PostCreateApiTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->profile = Profile::factory()->create();
    }

    public function test_新規投稿()
    {
        Storage::fake('s3');

        $images = [];
        for ($i = 1; $i <= 6; $i++)
        {
            array_push($images, array( 'image' => UploadedFile::fake()->image("image{$i}.png") ));
        }

        $response = $this
            ->actingAs($this->user)
            ->json('POST', route('posts.store'), $data = [
                'text' => $this->faker->paragraph,
                'place' => $this->faker->address,
                'files' => $images,
            ]);

        $post = Post::first();
        $this->assertEquals($data['text'], $post->text);
        $this->assertCount(6, $post->images);

        $response
            ->assertStatus(201)
            ->assertJson(['text' => $post->text]);
    }
}
