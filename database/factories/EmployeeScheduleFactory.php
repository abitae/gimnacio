<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Employee;
use App\Models\EmployeeSchedule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeeSchedule>
 */
class EmployeeScheduleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmployeeSchedule::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startHour = fake()->numberBetween(6, 18);
        $endHour = $startHour + fake()->numberBetween(4, 8);
        $endHour = min($endHour, 22); // No pasar de las 10 PM

        return [
            'employee_id' => Employee::factory(),
            'branch_id' => Branch::factory(),
            'day_of_week' => fake()->randomElement(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']),
            'start_time' => sprintf('%02d:00', $startHour),
            'end_time' => sprintf('%02d:00', $endHour),
        ];
    }

    /**
     * Indicate that the schedule is for weekdays.
     */
    public function weekday(): static
    {
        return $this->state(fn (array $attributes) => [
            'day_of_week' => fake()->randomElement(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']),
        ]);
    }

    /**
     * Indicate that the schedule is for weekend.
     */
    public function weekend(): static
    {
        return $this->state(fn (array $attributes) => [
            'day_of_week' => fake()->randomElement(['Saturday', 'Sunday']),
        ]);
    }

    /**
     * Indicate a morning shift.
     */
    public function morningShift(): static
    {
        return $this->state(fn (array $attributes) => [
            'start_time' => '08:00',
            'end_time' => '14:00',
        ]);
    }

    /**
     * Indicate an afternoon shift.
     */
    public function afternoonShift(): static
    {
        return $this->state(fn (array $attributes) => [
            'start_time' => '14:00',
            'end_time' => '20:00',
        ]);
    }
}
