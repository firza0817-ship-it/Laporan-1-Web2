<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;

// Rute Publik (Tanpa Token)
Route::prefix('v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

// Rute Terproteksi (Hanya butuh auth:sanctum saja)
Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('items', ItemController::class);
});
// Rute sementara buat maksa ubah role firza07@gmail.com jadi admin
Route::get('/v1/set-admin', function() {
    $user = \App\Models\User::where('email', 'firza007@gmail.com')->first();
    if ($user) {
        $user->role = 'admin';
        $user->save();
        return response()->json(['message' => 'Akun firza007 berhasil jadi admin!']);
    }
    return response()->json(['message' => 'Email gak ketemu di MySQL, cek ketikanmu!'], 404);
});