# Dokumentasi API - Inventory

## Endpoint Items

### GET /api/v1/items
Mengambil semua daftar item dengan opsi filter category_id.

* **URL:** `/api/v1/items`
* **Method:** `GET`
* **Query Parameters:**
  * `category_id` (optional, integer) - Menyaring barang berdasarkan ID kategori.

* **Response Sukses (200 OK):**
```json
{
  "success": true,
  "message": "Retrieve data successfully",
  "data": []
}