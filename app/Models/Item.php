<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // Ini sudah benar, pastikan ejaannya sama dengan di database
    protected $fillable = ['name', 'quantity', 'price', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}