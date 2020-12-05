<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_新規ユーザーを作成()
    {

        $response = $this
            ->json('POST', route('register'), $data = [
                'userid' => 'testuser',
                'email' => 'dummy@email.com',
                'password' => 'test1234',
                'password_confirmation' => 'test1234',
            ]);

        $user = User::first();
        $this->assertEquals('@'.$data['userid'], $user->userid);

        $response
            ->assertStatus(201)
            ->assertJson(['userid' => $user->userid]);
    }
}
