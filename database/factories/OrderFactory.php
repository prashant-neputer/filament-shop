<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\User;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'order_number' => fake()->regexify('[A-Za-z0-9]{50}'),
            'user_id' => User::factory(),
            'subtotal' => fake()->randomFloat(2, 0, 99999999.99),
            'tax' => fake()->randomFloat(2, 0, 99999999.99),
            'shipping_cost' => fake()->randomFloat(2, 0, 99999999.99),
            'total_amount' => fake()->randomFloat(2, 0, 99999999.99),
            'status' => fake()->randomElement(["pending","processing","shipped","delivered","cancelled"]),
            'payment_status' => fake()->randomElement(["pending","paid","failed","refunded"]),
            'payment_method' => fake()->regexify('[A-Za-z0-9]{50}'),
            'shipping_address' => fake()->text(),
            'billing_address' => fake()->text(),
            'notes' => fake()->text(),
        ];
    }
}
