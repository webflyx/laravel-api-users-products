<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function create(array $data)
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name']
        ]);

        if(isset($data['products_id'])) {
            foreach($data['products_id'] as $product_id){
                DB::table('product_user')->insert([
                    'user_id'=> $user->id,
                    'product_id'=> $product_id,
                ]);
            }
        }

        if(isset($data['avatar'])){
            $file = $data['avatar'];
            $path = $file->store('avatars', 'public');

            $user->update([
                'avatar' => $path
            ]);
        }
    }
}