<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductService
{

    public function create(array $data)
    {
        $product = Product::create([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'price' => $data['price'],
        ]);

        if (isset($data['users_id'])) {
            $product->users()->attach($data['users_id']);
        }
    }

    public function update(Product $product, array $data)
    {
        $product->update([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'price' => $data['price']
        ]);

        if (isset($data['users_id'])) {
            $product->users()->sync($data['users_id']);
        }
    }

    public function delete(Product $product)
    {
        $product->users()->detach();
        $product->delete();
    }
}
