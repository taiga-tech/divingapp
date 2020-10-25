<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\PostImage;

class PostImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Post::all() as $post )
        {
            PostImage::create([
                'path' => Storage::putFile('post/'.$post->id, 'public/default.png', file('public/default.png')),
                'post_id' => $post->id
            ]);
        }
    }
}
