<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_creator' =>$this->faker->numberBetween(1, User::count()),
            'category_id' => $this->faker->numberBetween(1, Category::count()),
            'name' => $this->faker->name(),
            'description' =>$this->faker->paragraph,
            'price' =>$this->faker->numberBetween(1,999),
            'condition' =>$this->faker->word,
            'status' => $this->faker->word,
            'path' =>$this->faker->imageUrl($width = 640, $height = 480),
        ];
    }
}
