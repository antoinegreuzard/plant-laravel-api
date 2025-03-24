<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlantResource;
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return PlantResource::collection(
            Plant::orderByDesc('created_at')->paginate(5)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): PlantResource
    {
        $validated = $request->validate([
            'name' => 'required|min:3|unique:plants,name',
            'plant_type' => 'required',
            // Ajoute ici les autres champs si besoin
        ]);

        $plant = Plant::create($validated);
        return new PlantResource($plant);
    }

    /**
     * Display the specified resource.
     */
    public function show(Plant $plant): PlantResource
    {
        return new PlantResource($plant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plant $plant): PlantResource
    {
        $plant->update($request->all());
        return new PlantResource($plant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plant $plant): Response
    {
        $plant->delete();
        return response()->noContent();
    }
}
