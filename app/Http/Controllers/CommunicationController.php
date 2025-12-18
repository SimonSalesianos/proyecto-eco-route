<?php

namespace App\Http\Controllers;

use App\Models\Communication;
use Illuminate\Http\Request;

class CommunicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Communication::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'channel' => 'string|in:email,sms,push,in-app',
            'audience' => 'nullable|string|max:255',
            'scheduled_at' => 'nullable|datetime',
            'sent_at' => 'nullable|datetime',
            'status' => 'string|in:draft,scheduled,sent,failed',
        ]);

        return Communication::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Communication $communication)
    {
        return $communication;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Communication $communication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Communication $communication)
    {
        $validated = $request->validate([
            'user_id' => 'exists:users,id',
            'title' => 'string|max:255',
            'body' => 'string',
            'channel' => 'string|in:email,sms,push,in-app',
            'audience' => 'nullable|string|max:255',
            'scheduled_at' => 'nullable|datetime',
            'sent_at' => 'nullable|datetime',
            'status' => 'string|in:draft,scheduled,sent,failed',
            'sent_count' => 'integer|min:0',
            'opened_count' => 'integer|min:0',
            'clicked_count' => 'integer|min:0',
        ]);

        $communication->update($validated);
        return $communication;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Communication $communication)
    {
        $communication->delete();
        return response()->json(null, 204);
    }
}
