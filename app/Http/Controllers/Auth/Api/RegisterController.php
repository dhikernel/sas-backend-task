<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request, User $user)
    {
        $registerData = $request->only('name', 'email', 'password');

        $registerData['password'] = bcrypt($registerData['password']);

        if (!$user = $user->create($registerData))
            abort(500, 'Error to create a new user!');

        return response()->json([
            'data' => [
                'user' => $user
            ]
        ]);
    }
}
