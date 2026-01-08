<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);
            return response()->json([
                "status" => true,
                "message" => "signup success",

            ]);
        } catch (\Throwable $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }
}
