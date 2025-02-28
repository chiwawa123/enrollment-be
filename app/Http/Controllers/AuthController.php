<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(['user' => $user, 'token' => $token]);
    }

    public function login(Request $request)
    {
        // Get email and password from request
        $credentials = $request->only('email', 'password');

        // Attempt authentication
        if (auth()->attempt($credentials)) {
            // Get the authenticated user
            $user = auth()->user();

            // Generate the JWT token for the authenticated user
            $token = JWTAuth::fromUser($user);

            // Return the token and user details
            return response()->json([
                'token' => $token,
                'user' => $user,
            ]);
        }

        // If authentication fails, return Unauthorized
        return response()->json(['error' => 'Unauthorized'], 401);
    }


    public function me()
    {
        return response()->json(Auth::user());
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
