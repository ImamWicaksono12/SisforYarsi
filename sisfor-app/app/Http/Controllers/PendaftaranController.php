<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Beasiswa;
use App\Models\BerkasPendaftaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;
use Carbon\Carbon;

class PendaftaranController extends Controller
{
    /**
     * List beasiswa aktif
     */
    public function index()
    {
        $data = Beasiswa::where('status', 'buka')
                        ->where('tanggal_selesai', '>=', Carbon::today())
                        ->latest()
                        ->get();

        return view('mahasiswa.daftar_beasiswa', compact('data'));
    }

    /**
     * Form daftar
     */
    public function daftar($id)
    {
        $beasiswa = Beasiswa::with('persyaratan')->findOrFail($id);

        // cek status & tanggal
        if ($beasiswa->status !== 'buka' || Carbon::now()->isAfter($beasiswa->tanggal_selesai)) {
            return back()->with('error', 'Pendaftaran sudah ditutup.');
        }

        $mahasiswa = Auth::user()->mahasiswa;

        if (!$mahasiswa) {
            return redirect()->route('home')->with('error', 'Profil mahasiswa tidak ditemukan.');
        }

        // cek sudah daftar
        $sudahDaftar = Pendaftaran::where('mahasiswa_id', $mahasiswa->id)
            ->where('beasiswa_id', $id)
            ->exists();

        if ($sudahDaftar) {
            return redirect()->route('mahasiswa.pendaftaran.riwayat')
                ->with('error', 'Anda sudah mendaftar beasiswa ini.');
        }

        return view('mahasiswa.form_daftar', compact('beasiswa'));
    }

    /**
     * Simpan pendaftaran
     */
    public function store(Request $request, $id)
    {
        $beasiswa = Beasiswa::with('persyaratan')->findOrFail($id);
        $mahasiswa = Auth::user()->mahasiswa;

        if (!$mahasiswa) {
            return back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        // VALIDASI
        $rules = [
            'ipk_manual' => 'required|numeric|between:0,4.00',
            'semester'   => 'required|integer|between:1,14',
        ];

        foreach ($beasiswa->persyaratan as $syarat) {
            $key = 'file_' . $syarat->id;
            $rules[$key] = ($syarat->wajib ? 'required' : 'nullable') . '|file|mimes:pdf,jpg,jpeg,png|max:5120';
        }

        $request->validate($rules);

        DB::beginTransaction();
        $uploadedFiles = [];

        try {
            // mapping jalur
            $jalur = match ($beasiswa->tipe_beasiswa) {
                'fully_funded'   => 'seleksi',
                'partial_funded' => 'mandiri_sk',
                'one_shot'       => 'antrean',
                default          => 'seleksi'
            };

            // simpan pendaftaran
            $pendaftaran = Pendaftaran::create([
                'mahasiswa_id'      => $mahasiswa->id,
                'beasiswa_id'       => $id,
                'semester'          => $request->semester,
                'ipk_manual'        => $request->ipk_manual,
                'jalur_pendaftaran' => $jalur,
                'status'            => 'pending',
                'tanggal_daftar'    => now(),
            ]);

            // upload berkas
            foreach ($beasiswa->persyaratan as $syarat) {
                $key = 'file_' . $syarat->id;

                if ($request->hasFile($key)) {
                    $file = $request->file($key);
                    $folder = $mahasiswa->nim ?? 'USER_' . Auth::id();

                    $filename = "SYARAT_{$syarat->id}_{$folder}_" . time() . '.' . $file->getClientOriginalExtension();

                    $path = $file->storeAs("berkas_beasiswa/{$folder}", $filename, 'public');
                    $uploadedFiles[] = $path;

                    BerkasPendaftaran::create([
                        'pendaftaran_id' => $pendaftaran->id,
                        'persyaratan_id' => $syarat->id, // ✅ SESUAI ERD
                        'file_path'      => $path,
                        'status_validasi'=> 'pending',
                        'catatan'        => null
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('mahasiswa.pendaftaran.riwayat')
                ->with('success', 'Pendaftaran berhasil dikirim!');

        } catch (Exception $e) {

            DB::rollBack();

            foreach ($uploadedFiles as $file) {
                Storage::disk('public')->delete($file);
            }

            return back()->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Riwayat
     */
    public function riwayat()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        if (!$mahasiswa) {
            return redirect()->route('home');
        }

        $data = Pendaftaran::with('beasiswa')
            ->where('mahasiswa_id', $mahasiswa->id)
            ->latest()
            ->get();

        return view('mahasiswa.riwayat', compact('data'));
    }

    /* ================= ADMIN ================= */

    public function adminIndex()
    {
        $data = Pendaftaran::with(['mahasiswa.user', 'beasiswa'])
            ->latest()
            ->get();

        return view('admin.pendaftaran.index', compact('data'));
    }

    public function show($id)
    {
        $pendaftaran = Pendaftaran::with([
            'mahasiswa.user',
            'mahasiswa.prodi',
            'berkasPendaftaran.persyaratan',
            'beasiswa'
        ])->findOrFail($id);

        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    public function verifikasiAdmin(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:validasi_admin,ditolak',
            'catatan' => 'nullable|string|max:500'
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);

        $pendaftaran->update([
            'status' => $request->status,
            'catatan_validasi' => $request->catatan,
        ]);

        return redirect()->route('admin.pendaftaran.index')
            ->with('success', 'Status berhasil diperbarui.');
    }
}