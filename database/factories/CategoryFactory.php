<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'image_url' => fake()->imageUrl(48, 48),
        ];
    }
}
