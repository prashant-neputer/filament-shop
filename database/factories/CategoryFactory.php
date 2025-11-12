<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'slug' => fake()->slug(),
            'image' => fake()->regexify('[A-Za-z0-9]{255}'),
            'description' => fake()->text(),
            'parent_id' => Category::factory(),
            'is_active' => fake()->boolean(),
            'sort_order' => fake()->word(),
        ];
    }
}
