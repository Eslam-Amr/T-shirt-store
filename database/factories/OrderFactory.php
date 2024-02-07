<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'day'=>now()->format('l'),
            'month'=>now()->format('F'),
            'year'=>now()->format('Y'),
            'quantity'=>fake()->numberBetween(1,10),
            'tracking_code'=>Str::random(5),

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
