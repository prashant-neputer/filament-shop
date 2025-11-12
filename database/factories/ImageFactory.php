<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Image;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'url' => fake()->url(),
            'alt' => fake()->regexify('[A-Za-z0-9]{255}'),
            'imageable_id' => fake()->randomNumber(),
            'imageable_type' => fake()->regexify('[A-Za-z0-9]{255}'),
            'sort_order' => fake()->word(),
        ];
    }
}
