<?php

namespace Database\Factories;

use App\Models\Plant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Plant>
 */
class PlantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(2, true),
            'variety' => fake()->optional()->word(),
            'plant_type' => fake()->randomElement(['indoor', 'outdoor', 'succulent', 'flower', 'tree']),
            'purchase_date' => fake()->optional()->date(),
            'location' => fake()->optional()->city(),
            'description' => fake()->optional()->sentence(),

            'watering_frequency' => fake()->numberBetween(3, 14),
            'fertilizing_frequency' => fake()->numberBetween(20, 60),
            'repotting_frequency' => fake()->numberBetween(180, 730),
            'pruning_frequency' => fake()->numberBetween(30, 180),

            'last_watering' => fake()->optional()->dateTimeBetween('-2 weeks', 'now')->format('Y-m-d'),
            'last_fertilizing' => fake()->optional()->dateTimeBetween('-2 months', 'now')->format('Y-m-d'),
            'last_repotting' => fake()->optional()->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
            'last_pruning' => fake()->optional()->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),

            'sunlight_level' => fake()->randomElement(['low', 'medium', 'high']),
            'temperature' => fake()->optional()->randomFloat(1, 10, 35),
            'humidity_level' => fake()->randomElement(['low', 'medium', 'high']),
        ];
    }
}
