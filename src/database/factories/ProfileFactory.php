<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

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
                'name' => 'test',
                'image' => '/default.png',
                'user_id' => $i,
            ];
        }

        return $data;
    }
}
