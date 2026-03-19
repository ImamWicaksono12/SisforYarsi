<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(array $credentials)
    {
        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();
            return true;
        }
        return false;
    }

    /**
     */
    public function getRedirectRoute()
    {
        $role = Auth::user()->role;

        return match ($role) {
            'admin'     => route('admin.dashboard'),
            'mahasiswa' => route('mahasiswa.dashboard'),
            'kaprodi'   => route('kaprodi.dashboard'),
            'warek'     => route('warek.dashboard'),
            default     => '/',
        };
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
}