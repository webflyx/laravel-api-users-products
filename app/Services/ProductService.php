<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductService
{
    private function setProductUserRelation(Product $product, $data)
    {
        if(isset($data['users_id'])) {
            DB::table('product_user')->where('product_id', $product->id)->delete();
            foreach($data['users_id'] as $user_id){
                DB::table('product_user')->insert([
                    'product_id'=> $product->id,
                    'user_id'=> $user_id,
                ]);
            }
        }
    }

    public function create(array $data)
    {
        $product = Product::create([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'price' => $data['price'],
        ]);

        $this->setProductUserRelation($product, $data);
    }

    public function update(Product $product, array $data)
    {
        $product->update([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'price' => $data['price']
        ]);

        $this->setProductUserRelation($product, $data);
    }



}