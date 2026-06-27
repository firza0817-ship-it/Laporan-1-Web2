<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Support\Facades\Log; //[cite: 1]

class ItemService
{
    public function create(array $data)
    {
        $item = Item::create($data); //[cite: 1]
        
        Log::info('Item created', [
            'id' => $item->id,
            'data' => $data
        ]); //[cite: 1]

        return $item; //[cite: 1]
    }

    public function update(int $id, array $data)
    {
        $item = Item::findOrFail($id);
        $item->update($data);

        Log::info('Item updated', [
            'id' => $id, 
            'changes' => $data
        ]); //[cite: 1]

        return $item;
    }

    public function delete(int $id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        
        Log::info('Item deleted', [
            'id' => $id
        ]); //[cite: 1]

        return true;
    }
}   