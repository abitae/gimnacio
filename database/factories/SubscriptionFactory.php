<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Subscription;
use App\Models\SubscriptionType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subscription::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subscriptionType = SubscriptionType::factory()->create();
        $startDate = fake()->dateTimeBetween('-1 year', 'now');
        $durationInDays = $subscriptionType->duration;
        $endDate = (clone $startDate)->modify("+{$durationInDays} days");

        return [
            'customer_id' => Customer::factory(),
            'subscription_type_id' => $subscriptionType->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'cost' => $subscriptionType->price,
        ];
    }

    /**
     * Indicate that the subscription is active.
     */
    public function active(): static
    {
        return $this->state(function (array $attributes) {
            $startDate = now()->subDays(5);
            $subscriptionType = SubscriptionType::find($attributes['subscription_type_id']);
            $durationInDays = $subscriptionType ? $subscriptionType->duration : 30;
            $endDate = (clone $startDate)->addDays($durationInDays);

            return [
                'start_date' => $startDate,
                'end_date' => $endDate,
            ];
        });
    }

    /**
     * Indicate that the subscription is expired.
     */
    public function expired(): static
    {
        return $this->state(function (array $attributes) {
            $endDate = now()->subDays(5);
            $subscriptionType = SubscriptionType::find($attributes['subscription_type_id']);
            $durationInDays = $subscriptionType ? $subscriptionType->duration : 30;
            $startDate = (clone $endDate)->subDays($durationInDays);

            return [
                'start_date' => $startDate,
                'end_date' => $endDate,
            ];
        });
    }
}
