<?php

use App\Models\User;

it('authenticates a user and returns tokens', function () {
    $user = User::factory()->create([
        'username' => 'antoine.greuzard',
        'password' => bcrypt('antoine'),
    ]);

    $response = $this->post('/api/token', [
        'username' => $user->username,
        'password' => 'antoine',
    ]);

    $response->assertOk();
    $response->assertJsonStructure(['access', 'refresh']);
});
