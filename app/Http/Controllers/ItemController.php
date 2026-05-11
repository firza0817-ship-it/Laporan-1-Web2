<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function index()
    {
        return response()->json(Item::with('category')->get());
    }

    public function store(Request $request)
    {
        // Pake cara ini biar response error-nya JSON, bukan redirect HTML
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal, cek inputan lo!',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $item = Item::create($request->all());
            return response()->json($item, 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $item = Item::with('category')->find($id);
        if (!$item) return response()->json(['message' => 'Barang gak ada'], 404);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        if (!$item) return response()->json(['message' => 'Gak ketemu barangnya'], 404);
        
        $item->update($request->all()); 
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = Item::find($id);
        if (!$item) return response()->json(['message' => 'Barang emang udah gak ada'], 404);
        
        $item->delete();
        return response()->json(null, 204);
    }
}