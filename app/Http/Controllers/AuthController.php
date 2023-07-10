<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $status = 'success';
        $message = 'User registered successfully';
        $data = $user;

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $status = 'success';
            $message = 'User authenticated successfully';
            $data = $user;

            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data
            ], 200);
        }

        $status = 'error';
        $message = 'Invalid credentials';
        $data = null;

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $status = 'success';
        $message = 'User logged out successfully';
        $data = null;

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], 200);
    }
}
