<?php

namespace App\Http\Controllers;

use App\Models\EnvironmentalImpact;
use Illuminate\Http\Request;

class EnvironmentalImpactController extends Controller
{
    public function index()
    {
        return response()->json(EnvironmentalImpact::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'scope' => 'required|string|in:daily,monthly,yearly',
            'year' => 'nullable|integer|min:2000',
            'month' => 'nullable|integer|min:1|max:12',
            'co2_emitted' => 'nullable|numeric|min:0',
            'co2_saved' => 'nullable|numeric|min:0',
            'distance_sustainable' => 'nullable|numeric|min:0',
            'trips_sustainable' => 'required|integer|min:0',
            'sustainable_share' => 'nullable|numeric|min:0|max:100',
            'is_final' => 'boolean',
            'notes' => 'nullable|string',
        ]);

        $environmentalImpact = EnvironmentalImpact::create($validated);
        return response()->json($environmentalImpact, 201);
    }

    public function show(EnvironmentalImpact $environmentalImpact)
    {
        return response()->json($environmentalImpact, 200);
    }

    public function update(Request $request, EnvironmentalImpact $environmentalImpact)
    {
        $validated = $request->validate([
            'user_id' => 'exists:users,id',
            'scope' => 'string|in:daily,monthly,yearly',
            'year' => 'nullable|integer|min:2000',
            'month' => 'nullable|integer|min:1|max:12',
            'co2_emitted' => 'nullable|numeric|min:0',
            'co2_saved' => 'nullable|numeric|min:0',
            'distance_sustainable' => 'nullable|numeric|min:0',
            'trips_sustainable' => 'integer|min:0',
            'sustainable_share' => 'nullable|numeric|min:0|max:100',
            'is_final' => 'boolean',
            'notes' => 'nullable|string',
        ]);

        $environmentalImpact->update($validated);
        return response()->json($environmentalImpact, 200);
    }

    public function destroy(EnvironmentalImpact $environmentalImpact)
    {
        $environmentalImpact->delete();
        return response()->json(['message' => 'Environmental impact deleted successfully'], 200);
    }
}
