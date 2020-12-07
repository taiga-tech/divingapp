<?php

namespace Database\Factories;

use App\Models\PostGood;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostGoodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostGood::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $data = [
            'boolean' => true,
            'post_id' => 1,
            'user_id' => 1,
            'profile_id' => 1,
        ];

        return $data;
    }
}
