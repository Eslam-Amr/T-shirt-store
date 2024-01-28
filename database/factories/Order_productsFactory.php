<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order_products>
 */
class Order_productsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            // 'id'=>fake()->id(),
            // 'quantity'=>fake()->numberBetween(1,10),
            // 'price'=>fake()->numberBetween(400,10000),
            'product_id' =>  Product::inRandomOrder()->first()->id,
            'order_id' =>  Order::inRandomOrder()->first()->id,

        ];
    }
}
