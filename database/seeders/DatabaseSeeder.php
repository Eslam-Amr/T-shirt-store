<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Banner;
use App\Models\Cart;
use App\Models\Cart_products;
use App\Models\Category;
use App\Models\Contact;
use App\Models\designer;
use App\Models\Order;
use App\Models\Order_products;
use App\Models\Product;
use App\Models\Slider;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // designer::factory(10)->create();
        User::factory(10)->create();
        Banner::factory(10)->create();
        Category::factory(3)->create();
        Product::factory(1000)->create();
        Cart::factory(10)->create();
        Order::factory(10)->create();
        Contact::factory(10)->create();
        Order_products::factory(10)->create();
        Cart_products::factory(10)->create();
        Wishlist::factory(10)->create();
        Slider::factory(10)->create();
    }
}
