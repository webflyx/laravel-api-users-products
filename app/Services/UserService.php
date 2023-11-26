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

        if (isset($data['products_id'])) {
            $user->products()->attach($data['products_id']);
        }

        if (isset($data['avatar'])) {
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

        if (isset($data['products_id'])) {
            $user->products()->sync($data['products_id']);
        }
    }

    public function delete(User $user)
    {
        $user->products()->detach();
        $user->delete();
    }
}
