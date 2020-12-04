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

class PostEditApiTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Storage::fake('s3');

        $this->user = User::factory()->create();

        $this->profile = Profile::factory()->create();

        $this->images = [];
        for ($i = 1; $i <= 5; $i++)
        {
            array_push($this->images, array( 'image' => UploadedFile::fake()->image("image{$i}.png") ));
        }

        $this->post = $this
            ->actingAs($this->user)
            ->json('POST', route('posts.store'), [
                'text' => $this->faker->paragraph,
                'place' => $this->faker->address,
                'files' => $this->images,
            ]);
    }

    public function test_編集画面で変更前の値を返却()
    {
        $response = $this->json('GET', route('posts.show', Post::first()->id));

        $post = Post::first();
        $response
            ->assertStatus(200)
            ->assertJson(['text' => $post->text]);
    }

    public function test_投稿編集()
    {
        Storage::fake('s3');
        $response = $this
            ->actingAs($this->user)
            ->json('PUT', route('posts.update', Post::first()->id), $data = [
                'text' => $this->faker->paragraph,
                'place' => $this->faker->address,
                'files' => [[ 'image' => UploadedFile::fake()->image("image.png") ]],
            ]);

        $post = Post::first();
        $this->assertEquals($data['text'], $post->text);
        $this->assertCount(6, $post->images);

        $response
            ->assertStatus(200)
            ->assertJson(['text' => $post->text]);
    }
}
