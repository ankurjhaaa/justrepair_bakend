<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'phone' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'phone' => 'Invalid phone or password',
        ]);
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
