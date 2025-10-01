<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JobListingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraph(5),
            'expired_date' => now()->addDays(rand(10, 60)),
        ];
    }
}
