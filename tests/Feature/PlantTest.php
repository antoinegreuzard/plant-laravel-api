<?php

use App\Models\Plant;

it('lists paginated plants', function () {
    Plant::factory()->count(7)->create();

    $response = $this->get('/api/plants');

    $response->assertOk();
    $response->assertJsonStructure([
        'count',
        'next',
        'previous',
        'results' => [
            '*' => ['id', 'name', 'plant_type', 'advice']
        ],
    ]);
});
