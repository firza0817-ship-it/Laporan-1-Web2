<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Http\Controllers\Controller; // Menggunakan Controller standar bawaan Laravel

class ItemController extends Controller
{
    public function index(Request $request)
    {
        try {
            // 1. Cek query dasar dari model Item
            $query = Item::query();

            // 2. Jika ada parameter category_id, lakukan filter
            if ($request->filled('category_id')) {
                $query->where('category_id', $request->category_id);
            }

            // 3. Ambil data hasil query
            $items = $query->get();

            // 4. Kembalikan response JSON sukses standar
            return response()->json([
                'success' => true,
                'data' => $items
            ], 200);

        } catch (\Throwable $e) {
            // JIKA TERJADI ERROR: Tangkap pesan error aslinya dan kirim ke Postman dalam bentuk JSON
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem!',
                'error_message' => $e->getMessage(), // Menampilkan pesan error asli (misal: Table not found)
                'error_file' => $e->getFile(),       // Menampilkan file penyebab error
                'error_line' => $e->getLine()        // Menampilkan baris kode penyebab error
            ], 500);
        }
    }
}