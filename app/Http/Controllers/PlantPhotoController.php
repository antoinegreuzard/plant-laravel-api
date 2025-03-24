<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlantPhotoResource;
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PlantPhotoController extends Controller
{
    public function index(Plant $plant): AnonymousResourceCollection
    {
        return PlantPhotoResource::collection(
            $plant->photos()->orderByDesc('uploaded_at')->get()
        );
    }

    public function store(Request $request, Plant $plant): PlantPhotoResource
    {
        $validated = $request->validate([
            'image' => 'required|image|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);

        $path = $request->file('image')->store('plant_photos', 'public');

        $photo = $plant->photos()->create([
            'image' => $path,
            'caption' => $validated['caption'] ?? null,
            'uploaded_at' => now(),
        ]);

        return new PlantPhotoResource($photo);
    }
}
