<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Order::class;
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 20),
            'quantity' => $this->faker->randomNumber(1),
            'price' => $this->faker->randomNumber(3),
            'status' => $this->faker->word
        ];
    }
}
