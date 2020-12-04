<?php

namespace Tests\Feature\Profiles;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProfileEditApiTest extends TestCase
{

    use WithFaker;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->profile = Profile::factory()->create();
    }

    public function test_プロフィールの編集()
    {
        Storage::fake('s3');

        $image = UploadedFile::fake()->image('image.png');

        $response = $this
            ->actingAs($this->user)
            ->json('PUT', route('profiles.update', $this->profile->id), $data = [
                'name' => $this->faker->userName,
                'image' => $image,
                'comment' => $this->faker->sentences,
            ]);

        $profile = Profile::first();
        $this->assertEquals($data['name'], $profile->name);

        $response
            ->assertStatus(200)
            ->assertJson(['name' => $profile->name]);
    }
}
