<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BeasiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'nama'            => 'required|string|max:255',
            'sumber_beasiswa' => 'required',
            'tipe_beasiswa'   => 'required|in:fully_funded,partial_funded,one_shot',
            'status'          => 'required|in:buka,tutup,aktif',
            'periode'         => 'required',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'kuota'           => 'nullable|integer',
            'deskripsi'       => 'nullable',
            'benefit'         => 'nullable',
            'gambar'          => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'persyaratan'     => 'required|array|min:1',
            'persyaratan.*'   => 'required|string',
            'wajib'           => 'required|array',
        ];
    }
}