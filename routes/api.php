<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
Route::get('/tes', function () {
    return response()->json([
        'status' => '200 OK',
        'nama' => 'Muhammad Firza Yasin'
    ]);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('categories', CategoryController::class);
Route::apiResource('items', ItemController::class);

