<?php
require __DIR__ . '/auth.php';

use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\EnvironmentalImpactController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\CommunicationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('challenges', ChallengeController::class);
Route::apiResource('rewards', RewardController::class);
Route::apiResource('environmental-impacts', EnvironmentalImpactController::class);
Route::apiResource('chat-messages', ChatMessageController::class);
Route::apiResource('communications', CommunicationController::class);

