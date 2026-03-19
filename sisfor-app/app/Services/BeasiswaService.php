<?php

namespace App\Services;

use App\Models\Beasiswa;
use Illuminate\Support\Facades\Storage;

class BeasiswaService
{
    public function storeBeasiswa(array $data, $image = null)
    {
        if ($image) {
            $data['gambar'] = $image->store('beasiswa/posters', 'public');
        }
        return Beasiswa::create($data);
    }

    public function updateBeasiswa(Beasiswa $beasiswa, array $data, $image = null)
    {
        if ($image) {
            if ($beasiswa->gambar) {
                Storage::disk('public')->delete($beasiswa->gambar);
            }
            $data['gambar'] = $image->store('beasiswa/posters', 'public');
        }
        
        $beasiswa->update($data);
        return $beasiswa;
    }

    public function deleteBeasiswa(Beasiswa $beasiswa)
    {
        if ($beasiswa->gambar) {
            Storage::disk('public')->delete($beasiswa->gambar);
        }
        return $beasiswa->delete();
    }
}