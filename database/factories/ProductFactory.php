<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'slug' => fake()->slug(),
            'sku' => fake()->regexify('[A-Za-z0-9]{100}'),
            'cost_price' => fake()->randomFloat(2, 0, 99999999.99),
            'mrp' => fake()->randomFloat(2, 0, 99999999.99),
            'selling_price' => fake()->randomFloat(2, 0, 99999999.99),
            'summary' => fake()->text(),
            'description' => fake()->text(),
            'attributes' => '{}',
            'stock_quantity' => fake()->word(),
            'brand_id' => Brand::factory(),
            'category_id' => Category::factory(),
            'is_active' => fake()->boolean(),
            'is_featured' => fake()->boolean(),
            'sort_order' => fake()->word(),
        ];
    }
}
