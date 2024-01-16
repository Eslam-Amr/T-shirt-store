<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
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
            'email'=>fake()->email(),
            'total'=>fake()->numberBetween(100,10000),
            'status'=>'pending',
            'notes'=>fake()->paragraph(2),
            'governorate'=>fake()->paragraph(1),
            'phone'=>fake()->phoneNumber(),
            'address'=>fake()->address(),
            'user_id' =>  User::inRandomOrder()->first()->id,
            'designer_id' =>  User::inRandomOrder()->first()->id,

        ];
    }
}
