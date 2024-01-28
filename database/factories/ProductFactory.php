<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\designer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
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
            'stock'=>fake()->numberBetween(1,100),
            'discount'=>fake()->numberBetween(1,100),
            'price'=>fake()->numberBetween(1,1100),
            'price_after_discount'=>fake()->numberBetween(1,1100),
            'status'=>'pending',
            'name'=>fake()->name(),
            'description'=>fake()->paragraph(1),
            'desinger'=>fake()->name(),
            'bestSeller'=>fake()->name(),
            'image'=>fake()->imageUrl(),
            'designer_id' => User::inRandomOrder()->first()->id,
            'Category_id' => Category::inRandomOrder()->first()->id,
          ];
    }
}
