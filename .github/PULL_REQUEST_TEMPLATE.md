## What does this PR do?
PR ini menerapkan logika filter item berdasarkan kategori (`category_id`) pada `ItemController@index` di level query database. Selain itu, PR ini juga memperbarui file dokumentasi API terkait parameter baru tersebut.

## Related Issue
Closes #1

## Changes
- `app/Http/Controllers/ItemController.php` : Menambahkan pengondisian `$request->filled('category_id')` pada method `index()`.
- `docs/api.md` : Menambahkan dokumentasi parameter query `category_id` pada endpoint GET item.

## Checklist
- [ ] I tested my code 
- [ ] I updated documentation 
- [ ] Code complies with coding standards
