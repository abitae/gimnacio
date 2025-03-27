<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\ClassModel;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassModel>
 */
class ClassModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClassModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $classNames = [
            'Yoga',
            'Pilates',
            'Spinning',
            'Zumba',
            'Crossfit',
            'Body Pump',
            'Boxeo',
            'Funcional',
            'Aquagym',
            'Dance',
        ];

        return [
            'nombre' => fake()->randomElement($classNames),
            'descripcion' => fake()->paragraph(2),
            'horario' => fake()->time('H:i'),
            'duracion' => fake()->randomElement([30, 45, 60, 90]),
            'instructor_id' => Employee::factory()->instructor(),
            'branch_id' => Branch::factory(),
            'capacity' => fake()->numberBetween(5, 30),
        ];
    }
}
