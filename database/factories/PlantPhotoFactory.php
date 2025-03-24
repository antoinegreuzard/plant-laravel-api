<?php

namespace Database\Factories;

use App\Models\Plant;
use App\Models\PlantPhoto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PlantPhoto>
 */
class PlantPhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'plant_id' => Plant::factory(),
            'image' => 'plant_photos/'.fake()->uuid().'.jpg',
            'caption' => fake()->optional()->sentence(),
            'uploaded_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
