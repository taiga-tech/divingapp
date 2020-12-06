<?php

namespace Tests\Feature\Posts\Comments;

use App\Models\Post;
use App\Models\User;
use App\Models\Profile;
use App\Models\PostComment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentDeleteApiTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->profile = Profile::factory()->create();
        $this->post = Post::factory()->create();
        $this->comment = PostComment::factory()->create();
    }

    public function test_コメント削除()
    {
        $response = $this
            ->actingAs($this->user)
            ->json('DELETE', route('comments.destroy', $this->comment->id));

        $response
            ->assertStatus(200);
    }
}
