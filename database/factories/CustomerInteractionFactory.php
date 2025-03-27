<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\CustomerInteraction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerInteraction>
 */
class CustomerInteractionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerInteraction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $interactionTypes = [
            'Consulta',
            'Reclamo',
            'Información',
            'Sugerencia',
            'Cambio de Plan',
            'Actualización de Datos',
            'Solicitud de Baja',
            'Promoción',
            'Recordatorio',
        ];

        return [
            'customer_id' => Customer::factory(),
            'interaction_date' => fake()->dateTimeBetween('-6 months', 'now'),
            'interaction_type' => fake()->randomElement($interactionTypes),
            'notes' => fake()->optional(0.8)->paragraph(),
        ];
    }

    /**
     * Indicate that the interaction is a complaint.
     */
    public function complaint(): static
    {
        return $this->state(fn (array $attributes) => [
            'interaction_type' => 'Reclamo',
            'notes' => fake()->paragraph(),
        ]);
    }

    /**
     * Indicate that the interaction is a promotion.
     */
    public function promotion(): static
    {
        return $this->state(fn (array $attributes) => [
            'interaction_type' => 'Promoción',
            'notes' => 'Oferta especial: ' . fake()->sentence(),
        ]);
    }
}
