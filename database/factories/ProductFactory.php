<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $price = rand(10,100);
        $tax = rand(1,10);
        $total = $price + $tax;
        return [
            'name' => $this->faker->unique()->word,
            'description' =>$this->faker->text(20),
            'price' => $price,
            'tax' => $tax,
            'total' => $total,
        ];
    }
}
