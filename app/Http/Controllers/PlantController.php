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
    public function index(Request $request): JsonResponse
    {
        $plants = Plant::where('user_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->paginate(10);

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

        $validated['user_id'] = $request->user()->id;

        $plant = Plant::create($validated);
        return new PlantResource($plant);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Plant $plant): PlantResource
    {
        if ($request->user()->id !== $plant->user_id) {
            abort(403, 'Non autorisé');
        }

        return new PlantResource($plant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plant $plant): PlantResource
    {
        if ($request->user()->id !== $plant->user_id) {
            abort(403, 'Non autorisé');
        }

        $plant->update($request->all());
        return new PlantResource($plant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Plant $plant): Response
    {
        if ($request->user()->id !== $plant->user_id) {
            abort(403, 'Non autorisé');
        }

        $plant->delete();
        return response()->noContent();
    }
}
