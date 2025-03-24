<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Plant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'variety', 'plant_type', 'purchase_date',
        'location', 'description',
        'watering_frequency', 'fertilizing_frequency',
        'repotting_frequency', 'pruning_frequency',
        'last_watering', 'last_fertilizing',
        'last_repotting', 'last_pruning',
        'sunlight_level', 'temperature', 'humidity_level'
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'last_watering' => 'date',
        'last_fertilizing' => 'date',
        'last_repotting' => 'date',
        'last_pruning' => 'date',
        'temperature' => 'float',
    ];

    public function photos(): HasMany
    {
        return $this->hasMany(PlantPhoto::class);
    }

    public function nextWatering(): ?Carbon
    {
        return $this->last_watering
            ? Carbon::parse($this->last_watering)->addDays($this->watering_frequency)
            : null;
    }

    public function nextFertilizing(): ?Carbon
    {
        return $this->last_fertilizing
            ? Carbon::parse($this->last_fertilizing)->addDays($this->fertilizing_frequency)
            : null;
    }

    public function nextRepotting(): ?Carbon
    {
        return $this->last_repotting
            ? Carbon::parse($this->last_repotting)->addDays($this->repotting_frequency)
            : null;
    }

    public function nextPruning(): ?Carbon
    {
        return $this->last_pruning
            ? Carbon::parse($this->last_pruning)->addDays($this->pruning_frequency)
            : null;
    }
}
