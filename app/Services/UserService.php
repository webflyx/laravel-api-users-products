<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function create(array $data)
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'products_id' => $data['products_id'] ?? null,
        ]);

        if(isset($data['avatar'])){
            $file = $data['avatar'];
            $path = $file->store('avatars', 'public');

            $user->update([
                'avatar' => $path
            ]);
        }
    }
}