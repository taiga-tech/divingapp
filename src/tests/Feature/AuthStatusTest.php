<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;
use App\Models\Profile;

class AuthStatusTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testGetRegisterStatus()
    {
        $response = $this
            ->get(route('register'))
            ->assertStatus(200);
    }

    public function testPostRegisterStatus()
    {
        $user = User::create([
            'userid' => '@'.$this->faker->userName,
            'email' => $this->faker->safeEmail,
            'password' => 'password',
            'password-confirm' => 'password',
        ]);
        $response = $this
            ->followingRedirects()
            ->post('register', [$user])
            ->assertStatus(200);
    }

    public function testGetProfileCreateStatus()
    {
        $user = User::factory()->create();
        $response = $this
            ->actingAs($user)
            ->get(route('profiles.create'))
            ->assertStatus(200);
    }

    // public function testPostProfileStoreStatus()
    // {
    //     $user = User::find(1);
    //     $profile = Profile::create([
    //         'name' => $user->userid,
    //         'image' => Storage::putFile('profile/'.$user->id, 'public/default.png', file('public/default.png')),
    //         'comment' => '',
    //         'user_id' => $user->id
    //     ]);
    //     $response = $this
    //         // ->followingRedirects()
    //         ->from('profile/create')
    //         ->actingAs($user)
    //         ->post('profiles/store', [$profile])
    //         ->assertStatus(200);
    // }

    public function testGetLoginStatus()
    {
        $response = $this
            ->get(route('login'))
            ->assertStatus(200);
    }

    public function testPostLoginStatus()
    {
        $user = User::find(1);
        $response = $this
            ->followingRedirects()
            ->post(route('login'), [$user])
            ->assertStatus(200);
    }
}
