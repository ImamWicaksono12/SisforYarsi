<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Beasiswa;
use App\Models\BerkasPendaftaran;
use App\Services\PendaftaranService;
use App\Http\Requests\PendaftaranRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PendaftaranController extends Controller
{
    protected $pendaftaranService;

    public function __construct(PendaftaranService $pendaftaranService)
    {
        $this->pendaftaranService = $pendaftaranService;
    }

    /**
     * Menampilkan daftar beasiswa yang tersedia untuk mahasiswa.
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
     * Menampilkan form pendaftaran untuk beasiswa tertentu.
     */
    public function daftar($id)
    {
        $beasiswa = Beasiswa::with('persyaratan')->findOrFail($id);
        
        return view('mahasiswa.form_daftar', compact('beasiswa'));
    }

    /**
     * Menyimpan data pendaftaran mahasiswa.
     */
    public function store(PendaftaranRequest $request, $id)
    {
        $beasiswa = Beasiswa::with('persyaratan')->findOrFail($id);
        $mahasiswa = Auth::user()->mahasiswa;

        if (!$mahasiswa) {
            return back()->with('error', 'Profil data mahasiswa tidak ditemukan. Silakan hubungi admin.');
        }

        $exists = Pendaftaran::where('beasiswa_id', $id)
            ->where('mahasiswa_id', $mahasiswa->id)
            ->exists();
        
        if ($exists) {
            return redirect()->route('mahasiswa.pendaftaran.riwayat')->with('error', 'Anda sudah mendaftar pada program beasiswa ini.');
        }

        $this->pendaftaranService->kirimPendaftaran(
            $beasiswa, 
            $mahasiswa, 
            $request->validated(), 
            $request->allFiles()
        );

        return redirect()->route('mahasiswa.pendaftaran.riwayat')->with('success', 'Pendaftaran berhasil dikirim!');
    }

    /**
     * Menampilkan riwayat pendaftaran mahasiswa yang sedang login.
     */
    public function riwayat()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        if (!$mahasiswa) {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $data = Pendaftaran::with(['beasiswa', 'berkas'])
            ->where('mahasiswa_id', $mahasiswa->id)
            ->latest()
            ->get();

        return view('mahasiswa.riwayat', compact('data'));
    }

    /**
     * FITUR BARU: Membatalkan pendaftaran.
     */
    public function cancel($id)
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $pendaftaran = Pendaftaran::where('mahasiswa_id', $mahasiswa->id)->findOrFail($id);

        $allowedStatus = ['pending', 'menunggu_kaprodi', 'menunggu_admin'];
        
        if (!in_array($pendaftaran->status, $allowedStatus)) {
            return redirect()->back()->with('error', 'Pendaftaran sudah diproses dan tidak dapat dibatalkan.');
        }

        foreach ($pendaftaran->berkas as $berkas) {
            if (Storage::disk('local')->exists($berkas->file_path)) {
                Storage::disk('local')->delete($berkas->file_path);
            }
        }

        $pendaftaran->delete();

        return redirect()->back()->with('success', 'Pendaftaran Anda berhasil dibatalkan.');
    }

    /**
     * Menampilkan file berkas secara aman.
     */
    public function viewFile($id)
    {
        $berkas = BerkasPendaftaran::findOrFail($id);
        $pendaftaran = Pendaftaran::findOrFail($berkas->pendaftaran_id);
        $user = Auth::user();

        // Keamanan: Cek kepemilikan berkas atau akses staf
        $isOwner = ($user->role === 'mahasiswa' && $user->mahasiswa && $pendaftaran->mahasiswa_id === $user->mahasiswa->id);
        $isAdmin = in_array($user->role, ['admin', 'kaprodi', 'warek']);

        if (!$isOwner && !$isAdmin) {
            abort(403, 'Akses tidak diizinkan.');
        }

        if (!Storage::disk('local')->exists($berkas->file_path)) {
            abort(404, 'File fisik tidak ditemukan di server.');
        }

        return response()->file(storage_path('app/' . $berkas->file_path));
    }
}