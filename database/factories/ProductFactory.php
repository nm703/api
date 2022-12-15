<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductCategory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category_id'=> ProductCategory::factory(),
            'user_id'=> User::factory(),
            'name'=>fake()->word(),
            'detail'=>fake()->sentence(6),
            'price'=>fake()->randomFloat(3,10,100), //3 decimale, izmedju 10 i 100
            'stock'=>fake()->randomNumber(2,false),
            'discount'=>fake()->randomFloat(2,5,10)
        ];
    }
}
