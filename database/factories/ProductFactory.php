<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
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
        $name = $this->faker->words(2, true);

        return [
            'name' => ucfirst($name),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 50, 2000),
            'stock' => $this->faker->numberBetween(1, 100),
            'image' => null,
            'category_id' => Category::factory(),
            'user_id' => null,
        ];
    }
}
