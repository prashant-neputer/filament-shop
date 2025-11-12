<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        if (!$token = auth()->attempt($validated)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        return $request->user();
    }

    public function register(Request $request)
    {
        
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
