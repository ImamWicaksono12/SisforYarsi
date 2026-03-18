<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Data Utama Widget (Real-time)
        $totalBeasiswa = Beasiswa::count();
        $pendaftarAktif = Pendaftaran::count(); 
        
        // KEAMANAN: Pastikan status sinkron dengan logika PendaftaranController (menunggu/pending)
        $menungguValidasi = Pendaftaran::whereIn('status', ['pending', 'menunggu'])->count();
        $totalDiterima = Pendaftaran::where('status', 'diterima')->count();

        // 2. Data Grafik Tren (Hardened)
        $currentYear = date('Y');
        $trenPendaftaran = Pendaftaran::select(
                DB::raw('COUNT(*) as total'),
                DB::raw("DATE_FORMAT(created_at, '%b') as bulan") 
            )
            ->whereYear('created_at', $currentYear)
            ->groupBy('bulan', DB::raw("MONTH(created_at)"))
            ->orderBy(DB::raw("MONTH(created_at)"), 'ASC')
            ->get();

        if ($trenPendaftaran->isEmpty()) {
            $trenPendaftaran = collect([['bulan' => date('M'), 'total' => 0]]);
        }

        // 3. Query Distribusi Fakultas (Eager Loading style join)
        $distribusiFakultas = Pendaftaran::join('mahasiswa', 'pendaftaran.mahasiswa_id', '=', 'mahasiswa.id')
            ->join('prodi', 'mahasiswa.prodi_id', '=', 'prodi.id')
            ->select('prodi.fakultas', DB::raw('COUNT(pendaftaran.id) as total'))
            ->groupBy('prodi.fakultas')
            ->get();

        // 4. Data Pendaftaran Terbaru
        // KEAMANAN: Membatasi kolom yang diambil untuk mencegah eksposur data sensitif
        $pendaftaranTerbaru = Pendaftaran::join('mahasiswa', 'pendaftaran.mahasiswa_id', '=', 'mahasiswa.id')
            ->join('users', 'mahasiswa.user_id', '=', 'users.id')
            ->join('prodi', 'mahasiswa.prodi_id', '=', 'prodi.id')
            ->join('beasiswa', 'pendaftaran.beasiswa_id', '=', 'beasiswa.id')
            ->select(
                'users.name as nama_mahasiswa',
                'prodi.nama_prodi',
                'beasiswa.nama as nama_beasiswa',
                'pendaftaran.tanggal_daftar',
                'pendaftaran.status',
                'pendaftaran.id as pendaftaran_id'
            )
            ->orderBy('pendaftaran.created_at', 'DESC')
            ->limit(5)
            ->get();

        return view('dashboard.admin', compact(
            'totalBeasiswa', 'pendaftarAktif', 'menungguValidasi', 
            'totalDiterima', 'trenPendaftaran', 'distribusiFakultas', 'pendaftaranTerbaru'
        ));
    }

    public function mahasiswaIndex()
    {
        // KEAMANAN: Validasi keberadaan user dan profil secara ketat
        $user = Auth::user();
        
        // Integrasi LDAP/SSO: Pastikan profil mahasiswa sudah terbuat di DB lokal
        if (!$user || !$user->mahasiswa) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Akses ditolak. Profil profil anda belum lengkap.');
        }

        $mahasiswaId = $user->mahasiswa->id;

        $countBeasiswa = Beasiswa::where('status', 'aktif')->count();
        $countPengajuan = Pendaftaran::where('mahasiswa_id', $mahasiswaId)->count();
        
        // KEAMANAN: Penanganan null pointer jika mahasiswa belum pernah mendaftar sama sekali
        $lastApplication = Pendaftaran::where('mahasiswa_id', $mahasiswaId)
            ->latest('created_at')
            ->first();

        $tren = Pendaftaran::select(
                DB::raw('COUNT(*) as total'),
                DB::raw("DATE_FORMAT(created_at, '%b') as bulan")
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('bulan', DB::raw("MONTH(created_at)"))
            ->orderBy(DB::raw("MONTH(created_at)"))
            ->get();

        return view('dashboard.mahasiswa', [
            'countBeasiswa' => $countBeasiswa,
            'countPengajuan' => $countPengajuan,
            // Perbaikan: Safely access status jika null
            'lastStatus' => $lastApplication ? $lastApplication->status : 'belum_daftar',
            'chartLabels' => $tren->pluck('bulan')->toArray(),
            'chartData' => $tren->pluck('total')->toArray()
        ]);
    }
}