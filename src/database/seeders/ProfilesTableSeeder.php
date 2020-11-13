<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Profile;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::all() as $user)
        {
            Profile::create([
                'name' => str_replace('@', '', $user->userid),
                'image' => Storage::putFile('profile/'.$user->id, 'public/default.png', file('public/default.png')),
                'comment' => '',
                'user_id' => $user->id
            ]);
        }
    }
}
