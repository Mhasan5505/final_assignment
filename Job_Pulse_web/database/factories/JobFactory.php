<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name,
            'user_id' => rand(1,4),
            'category_id' => rand(1,4),
            'job_type_id' => rand(1,4),
            'vacancy' => rand(1,10),
            'location' => fake()->city,
            'description' => fake()->text,
            'keywords' => fake()->text,
            'company_name' => fake()->name,
            'company_location' => fake()->city,
            'company_website' => fake()->text,
        ];
    }
}
