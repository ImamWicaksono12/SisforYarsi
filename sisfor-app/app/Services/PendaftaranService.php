<?php

namespace App\Services;

use App\Models\Pendaftaran;
use App\Models\BerkasPendaftaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Exception;

class PendaftaranService
{
    /**
     */
    public function kirimPendaftaran($beasiswa, $mahasiswa, $requestData, $files)
    {
        $uploadedPaths = [];

        return DB::transaction(function () use ($beasiswa, $mahasiswa, $requestData, $files, &$uploadedPaths) {
            try {
                $pendaftaran = Pendaftaran::create([
                    'mahasiswa_id'      => $mahasiswa->id,
                    'beasiswa_id'       => $beasiswa->id,
                    'semester'          => $requestData['semester'],
                    'ipk_manual'        => $requestData['ipk_manual'],
                    'jalur_pendaftaran' => $this->mapJalur($beasiswa->tipe_beasiswa),
                    'status'            => 'pending',
                    'tanggal_daftar'    => now(),
                ]);

                foreach ($beasiswa->persyaratan as $syarat) {
                    $key = 'file_' . $syarat->id;
                    
                    if (isset($files[$key]) && $files[$key]->isValid()) {
                        $extension = $files[$key]->getClientOriginalExtension();
                        $namaAsli = $files[$key]->getClientOriginalName();
                        $filename = "SYARAT_{$syarat->id}_" . time() . ".{$extension}";
                        
                        $path = $files[$key]->storeAs(
                            "private_berkas/{$mahasiswa->nim}", 
                            $filename, 
                            'local'
                        );
                        
                        $uploadedPaths[] = $path;
                        BerkasPendaftaran::create([
                            'pendaftaran_id' => $pendaftaran->id,
                            'persyaratan_id' => $syarat->id,
                            'nama_berkas'    => $namaAsli, 
                            'file_path'      => $path,
                            'status_validasi'=> 'pending',
                        ]);
                    }
                }
                
                return $pendaftaran;

            } catch (Exception $e) {
                foreach ($uploadedPaths as $filePath) {
                    Storage::disk('local')->delete($filePath);
                }
                throw $e;
            }
        });
    }

    /**
     * Mapping tipe beasiswa ke jalur pendaftaran.
     */
    private function mapJalur($tipe)
    {
        return match ($tipe) {
            'fully_funded'   => 'seleksi',
            'partial_funded' => 'mandiri_sk',
            'one_shot'       => 'antrean',
            default          => 'seleksi'
        };
    }
}