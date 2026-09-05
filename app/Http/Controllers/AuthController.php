<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin() { return view('auth.login'); }

    public function login(Request $request)
    {
        $credentials = $request->validate(['email' => 'required', 'password' => 'required']);
        if (Auth::attempt($credentials)) {
            return Auth::user()->role === 'admin' ? redirect('/admin') : redirect('/');
        }
        return back()->withErrors(['email' => 'Login gagal']);
    }

    public function logout() { Auth::logout(); return redirect('/'); }
}
