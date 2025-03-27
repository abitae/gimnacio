<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\CustomerAccess;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerAccess>
 */
class CustomerAccessFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerAccess::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $accessDate = fake()->dateTimeBetween('-1 month', 'now');

        // Hora de acceso entre 6:00 AM y 10:00 PM
        $hour = fake()->numberBetween(6, 22);
        $minute = fake()->randomElement([0, 15, 30, 45]);
        $accessTime = sprintf('%02d:%02d', $hour, $minute);

        return [
            'customer_id' => Customer::factory(),
            'access_date' => $accessDate,
            'access_time' => $accessTime,
        ];
    }

    /**
     * Indicate that the access was today.
     */
    public function today(): static
    {
        return $this->state(fn (array $attributes) => [
            'access_date' => now(),
        ]);
    }
}
