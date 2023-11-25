<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserService
{
    private function setProductUserRelation(User $user, $data)
    {
        if(isset($data['products_id'])) {
            DB::table('product_user')->where('user_id', $user->id)->delete();
            foreach($data['products_id'] as $product_id){
                DB::table('product_user')->insert([
                    'user_id'=> $user->id,
                    'product_id'=> $product_id,
                ]);
            }
        }
    }

    public function create(array $data)
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name']
        ]);

        $this->setProductUserRelation($user, $data);

        if(isset($data['avatar'])){
            $file = $data['avatar'];
            $path = $file->store('avatars', 'public');

            $user->update([
                'avatar' => $path
            ]);
        }
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