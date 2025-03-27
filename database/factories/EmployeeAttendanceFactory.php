<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\EmployeeAttendance;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeeAttendance>
 */
class EmployeeAttendanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmployeeAttendance::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fecha = fake()->dateTimeBetween('-1 month', 'now');
        $horaEntrada = fake()->dateTimeBetween('08:00', '10:00');

        // 10% de probabilidad de que no haya hora de salida (todavía trabajando)
        $horaSalida = fake()->optional(0.9)->dateTimeBetween('16:00', '20:00');

        return [
            'empleado_id' => Employee::factory(),
            'fecha' => $fecha,
            'hora_entrada' => $horaEntrada->format('H:i'),
            'hora_salida' => $horaSalida ? $horaSalida->format('H:i') : null,
        ];
    }

    /**
     * Indicate that the attendance is for today.
     */
    public function today(): static
    {
        return $this->state(fn (array $attributes) => [
            'fecha' => now(),
        ]);
    }

    /**
     * Indicate that the employee has not checked out yet.
     */
    public function notCheckedOut(): static
    {
        return $this->state(fn (array $attributes) => [
            'hora_salida' => null,
        ]);
    }
}
