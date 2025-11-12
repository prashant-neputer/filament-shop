<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Brand;

class BrandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Brand::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'slug' => fake()->slug(),
            'logo' => fake()->regexify('[A-Za-z0-9]{255}'),
            'website' => fake()->regexify('[A-Za-z0-9]{255}'),
            'description' => fake()->text(),
            'is_active' => fake()->boolean(),
            'sort_order' => fake()->word(),
        ];
    }
}
