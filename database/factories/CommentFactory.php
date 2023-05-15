<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1,5),
            'event' => $this->faker->numberBetween(0,1),
            'dominant_hand' => $this->faker->numberBetween(0,1),
            'available' => $this->faker->numberBetween(0,1),
            'sale' => $this->faker->numberBetween(0,1),
            'recommends' => $this->faker->numberBetween(0,5),
        ];
    }
}
