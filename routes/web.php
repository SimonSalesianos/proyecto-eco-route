<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';


Route::get('/reset-admin', function () {
    \App\Models\User::where('role', 'admin')
        ->update(['password' => \Hash::make('Admin1234!')]);
    return 'Contraseña actualizada a: Admin1234!';
});


Route::get('/ver-admin', function () {
    $user = \App\Models\User::where('role', 'admin')->first();
    return response()->json([
        'email' => $user->email,
        'name'  => $user->name,
    ]);
});
