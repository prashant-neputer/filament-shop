<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderItem::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'quantity' => fake()->word(),
            'price' => fake()->randomFloat(2, 0, 99999999.99),
            'subtotal' => fake()->randomFloat(2, 0, 99999999.99),
            'product_id' => Product::factory(),
            'order_id' => Order::factory(),
            'product_snapshot' => '{}',
        ];
    }
}
