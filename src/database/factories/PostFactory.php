<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        for ($i = 0; $i <= User::count(); $i++)
        {
            $data = [
                'text' => 'test',
                'place' => '福岡',
                'user_id' => $i,
                'profile_id' => $i,
            ];
        }

        return $data;
    }
}
