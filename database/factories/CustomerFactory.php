<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'fecha_nacimiento' => fake()->dateTimeBetween('-60 years', '-18 years'),
            'email' => fake()->unique()->safeEmail(),
            'telefono' => fake()->phoneNumber(),
            'direccion' => fake()->address(),
            'branch_id' => Branch::factory(),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }

    /**
     * Indicate that the customer is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }
}
