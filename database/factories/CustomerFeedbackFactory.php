<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\CustomerFeedback;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerFeedback>
 */
class CustomerFeedbackFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerFeedback::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'feedback_date' => fake()->dateTimeBetween('-3 months', 'now'),
            'rating' => fake()->numberBetween(1, 5),
            'comments' => fake()->optional(0.8)->paragraph(),
        ];
    }

    /**
     * Indicate that the feedback is positive.
     */
    public function positive(): static
    {
        return $this->state(fn (array $attributes) => [
            'rating' => fake()->numberBetween(4, 5),
            'comments' => fake()->optional(0.9)->sentences(2, true),
        ]);
    }

    /**
     * Indicate that the feedback is negative.
     */
    public function negative(): static
    {
        return $this->state(fn (array $attributes) => [
            'rating' => fake()->numberBetween(1, 2),
            'comments' => fake()->optional(0.95)->sentences(3, true),
        ]);
    }
}
