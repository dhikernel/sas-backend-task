<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!auth()->attempt($credentials)) abort(401, 'Invalid Credentials!');

        $token = auth()->user()->createToken('auth_token');

        return response()->json([
            'data' => [
                'token' => $token->plainTextToken, 200
            ]
        ]);
    }
    public function user(Request $request)
    {
        $user = auth()->user();

        return response()->json($user, 200);
    }
    public function logout()
    {
        //auth()->user()->tokens()->delete(); //delete all tokens of user

        auth()->user()->currentAccessToken()->delete();

        return response()->json([], 204);
    }
}
