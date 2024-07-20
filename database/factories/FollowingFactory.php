<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\following>
 */
class FollowingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'      => User::factory(),
            'following_id' => User::factory(),
            'created_at'   => $this->faker->dateTimeThisMonth(),
            'updated_at'   => $this->faker->dateTimeThisMonth(),
        ];
    }
}
