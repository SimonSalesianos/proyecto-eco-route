<?php

namespace App\Http\Controllers;

use App\Models\Communication;
use Illuminate\Http\Request;

class CommunicationController extends Controller
{
    public function index()
    {
        return response()->json(Communication::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'channel' => 'required|string|in:email,sms,push,in-app',
            'audience' => 'nullable|string|max:255',
            'scheduled_at' => 'nullable|date',
            'sent_at' => 'nullable|date',
            'status' => 'required|string|in:draft,scheduled,sent,failed',
        ]);

        $communication = Communication::create($validated);
        return response()->json($communication, 201);
    }

    public function show(Communication $communication)
    {
        return response()->json($communication, 200);
    }

    public function update(Request $request, Communication $communication)
    {
        $validated = $request->validate([
            'user_id' => 'exists:users,id',
            'title' => 'string|max:255',
            'body' => 'string',
            'channel' => 'string|in:email,sms,push,in-app',
            'audience' => 'nullable|string|max:255',
            'scheduled_at' => 'nullable|date',
            'sent_at' => 'nullable|date',
            'status' => 'string|in:draft,scheduled,sent,failed',
            'sent_count' => 'integer|min:0',
            'opened_count' => 'integer|min:0',
            'clicked_count' => 'integer|min:0',
        ]);

        $communication->update($validated);
        return response()->json($communication, 200);
    }

    public function destroy(Communication $communication)
    {
        $communication->delete();
        return response()->json(['message' => 'Communication deleted successfully'], 200);
    }
}
