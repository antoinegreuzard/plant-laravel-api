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
            'name' => $this->faker->unique()->words(2, true),
            'variety' => $this->faker->optional()->word(),
            'plant_type' => $this->faker->randomElement(['indoor', 'outdoor', 'succulent', 'flower', 'tree']),
            'purchase_date' => $this->faker->optional()->date(),
            'location' => $this->faker->optional()->city(),
            'description' => $this->faker->optional()->sentence(),

            'watering_frequency' => $this->faker->numberBetween(3, 14),
            'fertilizing_frequency' => $this->faker->numberBetween(20, 60),
            'repotting_frequency' => $this->faker->numberBetween(180, 730),
            'pruning_frequency' => $this->faker->numberBetween(30, 180),

            'last_watering' => $this->faker->optional()->dateTimeBetween('-2 weeks', 'now')->format('Y-m-d'),
            'last_fertilizing' => $this->faker->optional()->dateTimeBetween('-2 months', 'now')->format('Y-m-d'),
            'last_repotting' => $this->faker->optional()->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
            'last_pruning' => $this->faker->optional()->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),

            'sunlight_level' => $this->faker->randomElement(['low', 'medium', 'high']),
            'temperature' => $this->faker->optional()->randomFloat(1, 10, 35),
            'humidity_level' => $this->faker->randomElement(['low', 'medium', 'high']),
        ];
    }
}
