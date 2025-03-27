<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $puestos = [
            'Recepcionista',
            'Entrenador',
            'Instructor de Yoga',
            'Instructor de Pilates',
            'Nutricionista',
            'Gerente',
            'Limpieza',
            'Mantenimiento',
        ];

        return [
            'nombre' => fake()->firstName(),
            'apellido' => fake()->lastName(),
            'puesto' => fake()->randomElement($puestos),
            'fecha_contratacion' => fake()->dateTimeBetween('-5 years', 'now'),
            'email' => fake()->unique()->safeEmail(),
            'status' => fake()->randomElement(['active', 'inactive']),
            'branch_id' => Branch::factory(),
        ];
    }

    /**
     * Indicate that the employee is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }

    /**
     * Indicate that the employee is an instructor.
     */
    public function instructor(): static
    {
        return $this->state(fn (array $attributes) => [
            'puesto' => 'Entrenador',
        ]);
    }
}
