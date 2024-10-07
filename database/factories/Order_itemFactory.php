<?php

namespace Database\Factories;

use App\Models\Order_item;
use Illuminate\Database\Eloquent\Factories\Factory;

class Order_itemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Order_item::class;

    public function definition()
    {
        return [
            'order_id' => $this->faker->numberBetween(1, 20),
            'product_id' => $this->faker->numberBetween(1, 20)
        ];
    }
}
