<?php

namespace App\Http\Requests; 

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Izinkan semua user untuk mengakses request ini.
     */
    public function authorize(): bool 
    { 
        return true; 
    }

    /**
     * Aturan validasi yang harus sesuai dengan atribut 'name' di form login.
     */
    public function rules(): array
    {
        return [
            'email'    => 'required|email', 
            'password' => 'required',
        ];
    }

    /**
     * Pesan error kustom (Opsional, agar lebih user-friendly)
     */
    public function messages(): array
    {
        return [
            'email.required'    => 'Alamat email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ];
    }
}