<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Branch>
 */
class BranchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Branch::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company() . ' ' . fake()->citySuffix(),
            'location' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->unique()->companyEmail(),
            'company_id' => Company::factory(),
        ];
    }
}
