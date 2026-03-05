<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\EnvironmentalImpactController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\CommunicationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login',    [AuthenticatedSessionController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user/current', function (Request $request) {
        $user = $request->user();
        return response()->json([
            'id'        => $user->id,
            'full_name' => $user->name,
            'email'     => $user->email,
        ]);
    });

    Route::get('/stats/current', function (Request $request) {
        $user = $request->user();
        return response()->json([
            'total_routes'       => 0,
            'total_co2_saved_kg' => (float) ($user->co2_saved ?? 0.0),
            'total_achievements' => 0,
        ]);
    });

    Route::get('/routes', function () {
        $routes = DB::table('routes')->get();
        return response()->json($routes);
    });

    Route::get('/challenges/active', function () {
        $challenges = \App\Models\Challenge::where('is_active', true)->get();
        return response()->json(
            $challenges->map(function ($c) {
                return [
                    'id'               => (string) $c->id,
                    'title'            => $c->title,
                    'description'      => $c->description ?? '',
                    'difficulty'       => match ((int) ($c->difficulty ?? 1)) {
                        1       => 'easy',
                        2       => 'medium',
                        default => 'hard',
                    },
                    'remaining_days'   => 0,
                    'progress_current' => 0,
                    'progress_total'   => $c->target_participants ?? 100,
                    'reward_points'    => $c->points_reward ?? 0,
                ];
            })
        );
    });

    Route::get('/chat/messages', function (Request $request) {
        $messages = \App\Models\ChatMessage::with('user')
            ->orderBy('created_at', 'asc')
            ->get();
        $userId = $request->user()->id;

        return response()->json(
            $messages->map(function ($m) use ($userId) {
                $name = $m->user->name ?? 'Usuario';
                return [
                    'id'              => (string) $m->id,
                    'author_name'     => $name,
                    'author_initials' => strtoupper(substr($name, 0, 2)),
                    'text'            => $m->content ?? '',
                    'created_at'      => $m->created_at,
                    'is_mine'         => $m->user_id === $userId,
                ];
            })
        );
    });

    Route::post('/chat/messages', function (Request $request) {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $message = \App\Models\ChatMessage::create([
            'user_id' => $request->user()->id,
            'content' => $request->input('content'),
        ]);

        $message->load('user');
        $name = $message->user->name ?? 'Usuario';

        return response()->json([
            'id'              => (string) $message->id,
            'author_name'     => $name,
            'author_initials' => strtoupper(substr($name, 0, 2)),
            'text'            => $message->content,
            'created_at'      => $message->created_at,
            'is_mine'         => true,
        ], 201);
    });

    // ── Resources ─────────────────────────────────────────────
    Route::apiResource('users',                 UserController::class);
    Route::apiResource('challenges',            ChallengeController::class);
    Route::apiResource('rewards',               RewardController::class);
    Route::apiResource('environmental-impacts', EnvironmentalImpactController::class);
    Route::apiResource('chat-messages',         ChatMessageController::class);
    Route::apiResource('communications',        CommunicationController::class);

    // ✅ Notificaciones
    Route::patch('notifications/{notification}/read', [NotificationController::class, 'markAsRead']);
    Route::apiResource('notifications',         NotificationController::class);

});

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
