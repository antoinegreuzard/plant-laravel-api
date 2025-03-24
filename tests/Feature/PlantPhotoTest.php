<?php

use App\Models\Plant;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

it('uploads a photo for a plant', function () {
    Storage::fake('public');

    $plant = Plant::factory()->create();
    $user = User::factory()->create();

    $token = auth('api')->login($user);

    $response = $this->post("/api/plants/$plant->id/upload-photo", [
        'image' => UploadedFile::fake()->image('plant.jpg'),
        'caption' => 'Ma belle plante',
    ], [
        'Authorization' => "Bearer $token"
    ]);

    $response->assertCreated();
    $response->assertJsonStructure(['data' => ['image']]);

    $imagePath = $response->json('data.image_url');

    Storage::disk('public')->assertExists('plant_photos/'.basename($imagePath));
});
