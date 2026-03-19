<?php

namespace App\Http\Requests;

use App\Models\Beasiswa;
use Illuminate\Foundation\Http\FormRequest;

class PendaftaranRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $beasiswa = Beasiswa::with('persyaratan')->find($this->route('id'));
        
        $rules = [
            'ipk_manual' => 'required|numeric|between:0,4.00',
            'semester'   => 'required|integer|between:1,14',
        ];

        if ($beasiswa) {
            foreach ($beasiswa->persyaratan as $syarat) {
                $key = 'file_' . $syarat->id;
                $rules[$key] = ($syarat->wajib ? 'required' : 'nullable') . '|file|mimes:pdf,jpg,jpeg,png|max:5120';
            }
        }

        return $rules;
    }
}