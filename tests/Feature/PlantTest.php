<?php

use App\Models\Plant;
use App\Models\User;

it('lists paginated plants', function () {
    $user = User::factory()->create();

    Plant::factory()->count(7)->for($user)->create();

    $response = $this->actingAs($user, 'api')->getJson('/api/plants');

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
