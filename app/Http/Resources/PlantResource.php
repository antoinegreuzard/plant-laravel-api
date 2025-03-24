<?php

namespace App\Http\Resources;

use App\Helpers\PlantAdviceHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'variety' => $this->variety,
            'plant_type' => $this->plant_type,
            'purchase_date' => $this->purchase_date,
            'location' => $this->location,
            'description' => $this->description,
            'created_at' => $this->created_at->toIso8601String(),

            'watering_frequency' => $this->watering_frequency,
            'fertilizing_frequency' => $this->fertilizing_frequency,
            'repotting_frequency' => $this->repotting_frequency,
            'pruning_frequency' => $this->pruning_frequency,

            'last_watering' => $this->last_watering,
            'last_fertilizing' => $this->last_fertilizing,
            'last_repotting' => $this->last_repotting,
            'last_pruning' => $this->last_pruning,

            'sunlight_level' => $this->sunlight_level,
            'temperature' => $this->temperature,
            'humidity_level' => $this->humidity_level,

            // Champs calculés
            'next_watering' => $this->nextWatering()?->toDateString(),
            'next_fertilizing' => $this->nextFertilizing()?->toDateString(),
            'next_repotting' => $this->nextRepotting()?->toDateString(),
            'next_pruning' => $this->nextPruning()?->toDateString(),

            // Nouveau : conseils personnalisés
            'advice' => PlantAdviceHelper::getPersonalizedAdvice($this->resource),
        ];
    }
}
