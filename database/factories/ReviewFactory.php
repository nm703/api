<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            
            'review'=> fake()->sentence(),
            'star'=> fake()->numberBetween(1,10),
            'product_id'=> function(){
                return Product::all()->random();
            },
            'user_id'=> function(){
                return User::all()->random();
            }

        ];
    }
}
