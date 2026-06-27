<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Models\Item;

Route::get('/tes', function () {
    return response()->json([
        'status' => '200 OK',
        'nama' => 'Muhammad Firza Yasin'
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->middleware([
    'auth:sanctum',   
    'throttle:60,1'  
])->group(function () {
    
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('items', ItemController::class);
    
});