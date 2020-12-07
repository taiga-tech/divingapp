<?php

namespace Tests\Feature\Posts\Comments;


use App\Models\Post;
use App\Models\User;
use App\Models\Profile;
use App\Models\PostComment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class CommentCreateApiTest extends TestCase
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

    public function test_コメント投稿()
    {
        $response = $this
            ->actingAs($this->user)
            ->json('POST', route('comments.store'), $data = [
                'content' => $this->faker->paragraph,
                'post_id' => $this->post->id,
            ]);

        $comment = PostComment::first();
        $this->assertEquals($data['content'], $comment->content);

        $response
            ->assertStatus(200)
            ->assertJson(['content' => $comment->content]);
    }
}
