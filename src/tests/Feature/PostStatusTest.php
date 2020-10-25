<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;

class PostStatusTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testGetIndexStatus()
    {
        $response = $this
            ->get('/')
            ->assertStatus(200);
    }

    public function testGetCreateStatus()
    {
        $user = User::all()->random();
        $response = $this
            ->actingAs($user)
            ->get('posts/create')
            ->assertStatus(200);
    }

    public function testPostStoreStatus()
    {
        $post = Post::factory()->make();
        $response = $this
            ->followingRedirects()
            ->post(route('posts.store', [$post]))
            ->assertStatus(200);
    }

    public function testGetShowStatus()
    {
        $post = Post::all()->random();
        $response = $this
            ->get(route('posts.show', $post->id))
            ->assertStatus(200);
    }

    public function testGetEditStatus()
    {
        $post = Post::all()->random();
        $user = User::find($post->user_id);
        $response = $this
            ->actingAs($user)
            ->get(route('posts.edit', $post->id))
            ->assertStatus(200);
    }

    public function testPutUpdateStatus()
    {
        $post = Post::factory()->create();
        $response = $this
            ->followingRedirects()
            ->put(route('posts.update', $post), [
                'text' => $this->faker->text,
                "user_id" => $post->user->id
            ])
            ->assertStatus(200);
    }

    public function testDeleteDestroyStatus()
    {
        $post = Post::factory()->create();
        $response = $this
            ->followingRedirects()
            ->delete(route('posts.destroy', $post))
            ->assertStatus(200);
    }

}
