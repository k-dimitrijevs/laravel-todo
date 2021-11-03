<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => null,
            'title' => $this->faker->sentence,
            'content' => $this->faker->sentence,
            'completed_at' => null
        ];
    }
}
