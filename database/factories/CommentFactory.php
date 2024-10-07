<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Comment::class;


    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, User::count()),
            'product_id' => $this->faker->numberBetween(1, Product::count()),
            'comment' => $this->faker->paragraph
        ];
    }
}
