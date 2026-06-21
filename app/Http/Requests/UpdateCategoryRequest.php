<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Mendapatkan ID Kategori dari rute URL agar validasi 'unique' mengabaikan ID kategori ini sendiri
        $id = $this->route('category')?->id ?? $this->route('category');

        return [
            'name' => "required|string|unique:categories,name,{$id}|max:255",
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Nama kategori sudah digunakan.',
        ];
    }
}

