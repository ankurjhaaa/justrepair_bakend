<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'mobile' => 'required|string',
            'password' => 'required|string',
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'phone' => $request->mobile,
                'password' => Hash::make($request->password),
            ]);
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                "status" => true,
                "message" => "signup success",
                "user" => $user,
                "token" => $token

            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }
    public function login(Request $request)
    {
        $request->validate([
            'mobile' => 'required|string',
            'password' => 'required|string',
        ]);
        try {
            $user = User::where('phone', $request->mobile)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'mobile' => ['Invalid mobile or password']
                ]);
            }
            $user->tokens()->delete();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user,
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }

    }
    public function logout(Request $request)
    {
        try {

            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'status' => true,
                'message' => 'Logged out successfully',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
