<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CartFactory extends Factory
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
            // "id"=>fake()->id(),
            "status"=>'show',
            "total"=>fake()->numberBetween(1,1000),
            "quantity"=> fake()->numberBetween(1,10),

            'designer_id' =>  User::inRandomOrder()->first()->id,
            'user_id' =>  User::inRandomOrder()->first()->id,
            // 'product_id' => Product::inRandomOrder()->first()->id
            // 'product_id' => '2',
        ];
    }
}
