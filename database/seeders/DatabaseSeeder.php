<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Item;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat 1 kategori
        $category = Category::create([
            'name' => 'Elektronik'
        ]);

        // Membuat 1 item yang terhubung ke kategori tersebut
        Item::create([
            'name' => 'Laptop LOQ',
            'quantity' => 10,
            'price' => 12000000,
            'category_id' => $category->id
        ]);
    }
}