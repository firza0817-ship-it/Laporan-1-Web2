<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index() {
        // Mengembalikan semua data barang (Skenario c)
        return response()->json(Item::all(), 200);
    }

    public function store(Request $request) {
        $item = Item::create($request->all());
        return response()->json($item, 201);
    }

    public function show($id) {
        $item = Item::find($id);
        if (!$item) return response()->json(['message' => 'Barang gak ketemu!'], 404);
        return response()->json($item, 200);
    }

    public function update(Request $request, $id) {
        $item = Item::find($id);
        if (!$item) return response()->json(['message' => 'Barang gak ketemu!'], 404);
        $item->update($request->all());
        return response()->json($item, 200);
    }

    public function destroy($id) {
        // Cek apakah user yang login rolenya beneran admin
        if (auth()->user()->role !== 'admin') {
            return response()->json(['message' => 'This action is unauthorized.'], 403);
        }

        $item = Item::find($id);
        if (!$item) return response()->json(['message' => 'Barang gak ketemu!'], 404);
        
        $item->delete();
        return response()->json(['message' => 'Barang berhasil dihapus'], 200);
    }
}