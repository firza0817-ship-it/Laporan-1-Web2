## Deskripsi Fitur / Perbaikan
Menambahkan fitur filter data items berdasarkan `category_id` pada endpoint API untuk memudahkan pengguna mencari barang berdasarkan kategorinya.

## Harapan / Ekspektasi
- Endpoint `GET /api/v1/items?category_id={id}` dapat mengembalikan data item yang sesuai dengan kategori yang dipilih.
- Jika `category_id` tidak dikirim, kembalikan semua data.
- Jika `category_id` tidak memiliki item, kembalikan array kosong dengan status 200 OK.

## Langkah Reproduksi (Khusus Bug)
1. Buka aplikasi Postman.
2. Kirim request `GET` ke endpoint `/api/v1/items?category_id=abc` (menggunakan string, bukan ID angka).
3. Server mengembalikan error `500 Internal Server Error` bukannya pesan validasi yang rapi.

## Label & Assignee
- **Label:** `enhancement`
- **Assignee:** @firzayxnn