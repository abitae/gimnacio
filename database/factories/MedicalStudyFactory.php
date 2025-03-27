<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\MedicalStudy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicalStudy>
 */
class MedicalStudyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MedicalStudy::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cliente_id' => Customer::factory(),
            'fecha' => fake()->dateTimeBetween('-6 months', 'now'),
            'peso' => fake()->randomFloat(2, 45, 120),
            'altura' => fake()->randomFloat(2, 140, 210),
            'presion_arterial' => fake()->randomElement([
                '120/80', '110/70', '130/85', '140/90', '100/65'
            ]),
            'recomendaciones' => fake()->optional(0.7)->paragraph(2),
        ];
    }
}
