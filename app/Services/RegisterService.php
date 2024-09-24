<?php

namespace App\Services;

use App\Models\User;
use App\Traits\FileControlTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    use FileControlTrait;

    public function userRegister(Request $request, $role = 'user'): User
    {
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $this->uploadFile($request->file('image'), 'users/profile');
        }

        $user =  User::create(
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'image' => $imagePath,
                'role' => $role,
                'status' => 'active',
                'password' => Hash::make($request->password),
            ]
        );

        return $user;
    }
}