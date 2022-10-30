<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Inertia\Inertia;

class UserService
{
    public function saveUser($data)
    {
        $data = $this->checkPassword($data);
        $data['api_token'] = Str::random(60);
        User::create($data);
    }

    public function updateUser($id, $data)
    {
        $data = $this->checkPassword($data);
        $data['api_token'] = Str::random(60);
        User::where('id', $id)->update($data);
    }

    public function deleteUser($id)
    {
        User::where('id', $id)->delete();
    }

    public function showForm($id = null)
    {
        if ($id) {
            $user = User::find($id);
        } else {
            $user = new User;
        }
        return Inertia::render('Users/Add', ['user' => $user]);
    }

    private function checkPassword($data)
    {
        if (isset($data['password']) && $data['password']) {
            $data['password'] = Hash::make($data['password']);
        }
        return $data;
    }
}
