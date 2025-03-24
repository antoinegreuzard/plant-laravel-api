<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlantResource;
use App\Models\Plant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $plants = Plant::orderByDesc('created_at')->paginate(10);

        return response()->json([
            'count' => $plants->total(),
            'next' => $plants->nextPageUrl(),
            'previous' => $plants->previousPageUrl(),
            'results' => PlantResource::collection($plants)->resolve(),
        ]);
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
