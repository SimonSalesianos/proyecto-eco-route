<?php

namespace App\Http\Controllers;

use App\Models\EnvironmentalImpact;
use Illuminate\Http\Request;

class EnvironmentalImpactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return EnvironmentalImpact::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
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

        return EnvironmentalImpact::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(EnvironmentalImpact $environmentalImpact)
    {
        return $environmentalImpact;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EnvironmentalImpact $environmentalImpact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
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
        return $environmentalImpact;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EnvironmentalImpact $environmentalImpact)
    {
        $environmentalImpact->delete();
        return response()->json(null, 204);
    }
}
