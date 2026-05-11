<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        return response()->json(Category::all());
    }

    public function store(Request $request) {
        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

    public function show($id) {
        $category = Category::find($id);
        if (!$category) return response()->json(['message' => 'Gak ada datanya!'], 404);
        return response()->json($category);
    }

    public function update(Request $request, $id) {
        $category = Category::find($id);
        if (!$category) return response()->json(['message' => 'Gak ketemu!'], 404);
        $category->update($request->all());
        return response()->json($category);
    }

    public function destroy($id) {
        Category::destroy($id);
        return response()->json(null, 204);
    }
}