<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
// SESUAIKAN: Hapus '\Auth' jika file LoginRequest.php ada di folder Requests langsung
use App\Http\Requests\LoginRequest; 
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if ($this->authService->login($request->validated())) {
            
            $redirectTo = $this->authService->getRedirectRoute();

            return redirect()->intended($redirectTo);
        }

        return back()->withErrors([
            'email' => 'Email atau Password salah.',
        ])->withInput($request->only('email'));
    }

    public function logout()
    {
        $this->authService->logout();
        return redirect('/login');
    }
}