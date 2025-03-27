<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\CustomerSupportTicket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerSupportTicket>
 */
class CustomerSupportTicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerSupportTicket::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'issue_date' => fake()->dateTimeBetween('-3 months', 'now'),
            'issue_description' => fake()->paragraph(),
            'status' => fake()->randomElement(['open', 'closed', 'in_progress']),
            'resolution_date' => function (array $attributes) {
                // Solo establecer fecha de resolución si el estado es "closed"
                if ($attributes['status'] === 'closed') {
                    return fake()->dateTimeBetween($attributes['issue_date'], 'now');
                }
                return null;
            },
        ];
    }

    /**
     * Indicate that the ticket is open.
     */
    public function open(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'open',
            'resolution_date' => null,
        ]);
    }

    /**
     * Indicate that the ticket is in progress.
     */
    public function inProgress(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'in_progress',
            'resolution_date' => null,
        ]);
    }

    /**
     * Indicate that the ticket is closed.
     */
    public function closed(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'closed',
                'resolution_date' => fake()->dateTimeBetween($attributes['issue_date'] ?? '-2 months', 'now'),
            ];
        });
    }
}
