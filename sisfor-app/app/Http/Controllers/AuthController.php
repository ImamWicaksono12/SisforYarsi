<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = Auth::user()->role;
            
            // Redirect berdasarkan role
            switch ($role) {
                case 'admin':
                    return redirect()->intended(route('admin.dashboard'));
                case 'mahasiswa':
                    return redirect()->intended(route('mahasiswa.dashboard'));
                case 'kaprodi':
                    return redirect()->intended(route('kaprodi.dashboard'));
                case 'warek':
                    return redirect()->intended(route('warek.dashboard'));
                default:
                    return redirect()->intended('/');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau Password salah.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/'); 
    }
}