<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paymentMethods = [
            'Efectivo',
            'Tarjeta de Crédito',
            'Tarjeta de Débito',
            'Transferencia Bancaria',
            'MercadoPago',
            'PayPal',
        ];

        return [
            'customer_id' => Customer::factory(),
            'amount' => fake()->randomFloat(2, 200, 2000),
            'payment_date' => fake()->dateTimeBetween('-1 year', 'now'),
            'payment_method' => fake()->randomElement($paymentMethods),
        ];
    }

    /**
     * Indicate that the payment is recent.
     */
    public function recent(): static
    {
        return $this->state(fn (array $attributes) => [
            'payment_date' => fake()->dateTimeBetween('-1 month', 'now'),
        ]);
    }
}
