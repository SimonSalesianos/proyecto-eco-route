<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return response()->json(Notification::orderBy('created_at', 'desc')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'  => 'required|integer|exists:users,id',
            'title'    => 'required|string|max:255',
            'message'  => 'required|string',
            'type'     => 'in:info,success,warning,error',
            'priority' => 'in:low,normal,high',
            'is_read'  => 'boolean',
        ]);

        $notification = Notification::create($data);
        return response()->json($notification, 201);
    }

    public function show(Notification $notification)
    {
        return response()->json($notification);
    }

    public function update(Request $request, Notification $notification)
    {
        $data = $request->validate([
            'user_id'  => 'integer|exists:users,id',
            'title'    => 'string|max:255',
            'message'  => 'string',
            'type'     => 'in:info,success,warning,error',
            'priority' => 'in:low,normal,high',
            'is_read'  => 'boolean',
        ]);

        $notification->update($data);
        return response()->json($notification);
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return response()->json(null, 204);
    }

    public function markAsRead(Notification $notification)
    {
        $notification->update(['is_read' => true]);
        return response()->json($notification);
    }
}
