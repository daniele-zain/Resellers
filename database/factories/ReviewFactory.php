<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reviewer_id' => $this->faker->numberBetween(1, 10),
            'reviewed_id' => $this->faker->numberBetween(1, 10),
            'review' => $this->faker->paragraph,
            'rating' => $this->faker->numberBetween(1, 2)
        ];
    }
}
