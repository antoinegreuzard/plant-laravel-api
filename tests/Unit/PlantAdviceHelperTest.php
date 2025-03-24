<?php

use App\Helpers\PlantAdviceHelper;
use App\Models\Plant;

it('gives proper advice based on plant attributes', function () {
    $plant = new Plant([
        'sunlight_level' => 'low',
        'humidity_level' => 'low',
    ]);

    $advice = PlantAdviceHelper::getPersonalizedAdvice($plant);

    expect($advice)->toBeArray()
        ->and($advice)->toContain("Placez votre plante à l'ombre ou dans un endroit peu lumineux.")
        ->and($advice)->toContain("Pulvérisez régulièrement de l'eau sur les feuilles.");
});
