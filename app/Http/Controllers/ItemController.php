<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Services\ItemService; 
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    protected $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    
    public function index(Request $request)
    {
        try {
            $query = Item::query();

            if ($request->filled('category_id')) {
                $query->where('category_id', $request->category_id);
            }

            $items = $query->get();
           
            return response()->json([
                'status' => 'success',
                'data' => $items,
                'message' => 'Data items berhasil diambil'
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem!',
                'error_message' => $e->getMessage()
            ], 500);
        }
    }

    
    public function store(Request $request)
    {
        try {
            
            $validated = $request->validate([
                'name' => 'required|string',
                'quantity' => 'required|integer',
                'price' => 'required|numeric',
                'category_id' => 'required|integer',
            ]);

        
            $item = $this->itemService->create($validated);

            return response()->json([
                'status' => 'success',
                'data' => $item,
                'message' => 'Item berhasil dibuat'
            ], 201);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat item!',
                'error_message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'name' => 'sometimes|required|string',
                'quantity' => 'sometimes|required|integer',
                'price' => 'sometimes|required|numeric',
                'category_id' => 'sometimes|required|integer',
            ]);

            $item = $this->itemService->update($id, $validated);

            return response()->json([
                'status' => 'success',
                'data' => $item,
                'message' => 'Item berhasil diperbarui'
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui item!',
                'error_message' => $e->getMessage()
            ], 500);
        }
    }

    
    public function destroy($id)
    {
        try {
            // 1. PROTEKSI ROLE: Cek apakah user yang sedang login adalah admin
            // Jika role user bukan admin, gagalkan proses dan kembalikan status 403 Forbidden
            if (auth()->user()->role !== 'admin') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Anda tidak memiliki hak akses untuk menghapus item ini.'
                ], 403);
            }

            // 2. Jika lolos pengecekan (berarti dia admin), lakukan proses hapus melalui service
            $this->itemService->delete($id);

            return response()->json(null, 204);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus item!',
                'error_message' => $e->getMessage()
            ], 500);
        }
    }
}