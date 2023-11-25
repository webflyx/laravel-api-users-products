<?php

namespace App\Services;

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductService
{
    private function setProductUserRelation(Product $product, $data)
    {
        if(isset($data['users_id'])) {
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
            'description' => $data['description'],
            'price' => $data['price'],
        ]);

        $this->setProductUserRelation($product, $data);
    }

    public function update(User $user, array $data)
    {
        $user->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name']
        ]);

        $this->setProductUserRelation($user, $data);
    }



}