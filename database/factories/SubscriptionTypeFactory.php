<?php

namespace Database\Factories;

use App\Models\SubscriptionType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubscriptionType>
 */
class SubscriptionTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubscriptionType::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subscriptionNames = [
            'Básica Mensual',
            'Premium Mensual',
            'Básica Trimestral',
            'Premium Trimestral',
            'Básica Anual',
            'Premium Anual',
            'Solo Clases',
            'Solo Fin de Semana',
        ];

        $durations = [
            30, // Mensual
            90, // Trimestral
            180, // Semestral
            365, // Anual
        ];

        return [
            'name' => fake()->randomElement($subscriptionNames),
            'description' => fake()->paragraph(2),
            'price' => fake()->numberBetween(200, 1500),
            'duration' => fake()->randomElement($durations),
        ];
    }

    /**
     * Indicate that the subscription is monthly.
     */
    public function monthly(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Mensual ' . fake()->word(),
            'duration' => 30,
            'price' => fake()->numberBetween(200, 500),
        ]);
    }

    /**
     * Indicate that the subscription is yearly.
     */
    public function yearly(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Anual ' . fake()->word(),
            'duration' => 365,
            'price' => fake()->numberBetween(1000, 1500),
        ]);
    }
}
