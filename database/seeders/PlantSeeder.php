<?php

namespace Database\Seeders;

use App\Models\Plant;
use App\Models\PlantPhoto;
use Illuminate\Database\Seeder;

class PlantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plant::factory()
            ->count(10)
            ->create()
            ->each(function ($plant) {
                PlantPhoto::factory()
                    ->count(rand(1, 3))
                    ->create(['plant_id' => $plant->id]);
            });
    }
}
