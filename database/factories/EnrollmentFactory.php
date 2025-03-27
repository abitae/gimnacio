<?php

namespace Database\Factories;

use App\Models\ClassModel;
use App\Models\Customer;
use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Enrollment>
 */
class EnrollmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Enrollment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cliente_id' => Customer::factory(),
            'clase_id' => ClassModel::factory(),
            'fecha_inscripcion' => fake()->dateTimeBetween('-3 months', 'now'),
        ];
    }
}
