<?php

use App\Models\Plant;
use Illuminate\Support\Carbon;

it('calculates next watering relative to now', function () {
    Carbon::setTestNow(Carbon::parse('2025-03-24'));

    $plant = new Plant([
        'last_watering' => Carbon::now()->subDays(3),
        'watering_frequency' => 5,
    ]);

    expect($plant->nextWatering()->toDateString())->toBe('2025-03-26');

    Carbon::setTestNow(); // important pour ne pas casser les autres tests
});

it('returns null when no last watering date is set', function () {
    $plant = new Plant([
        'last_watering' => null,
        'watering_frequency' => 3,
    ]);

    expect($plant->nextWatering())->toBeNull();
});
