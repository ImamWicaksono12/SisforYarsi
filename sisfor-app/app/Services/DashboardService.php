<?php

namespace App\Services;

use App\Models\Beasiswa;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardService
{
    /**
     * Mendapatkan data statistik lengkap untuk Admin
     */
    public function getAdminStats()
    {
        return [
            'widgets' => [
                'totalBeasiswa'    => Beasiswa::count(),
                'pendaftarAktif'   => Pendaftaran::count(),
                'menungguValidasi' => Pendaftaran::whereIn('status', ['pending', 'menunggu'])->count(),
                'totalDiterima'    => Pendaftaran::where('status', 'diterima')->count(),
            ],
            'tren' => $this->getMonthlyTrend(),
            'distribusiFakultas' => $this->getFacultyDistribution(),
            'terbaru' => Pendaftaran::with(['mahasiswa.user', 'mahasiswa.prodi', 'beasiswa'])
                            ->latest()->limit(5)->get()
        ];
    }

    /**
     * Mendapatkan data statistik untuk Mahasiswa tertentu
     */
    public function getMahasiswaStats($mahasiswa)
    {
        $mahasiswaId = $mahasiswa->id;

        $tren = Pendaftaran::where('mahasiswa_id', $mahasiswaId)
            ->select(DB::raw('COUNT(*) as total'), DB::raw("DATE_FORMAT(created_at, '%b') as bulan"))
            ->whereYear('created_at', date('Y'))
            ->groupBy('bulan', DB::raw("MONTH(created_at)"))
            ->orderBy(DB::raw("MONTH(created_at)"))
            ->get();

        return [
            'countBeasiswa'  => Beasiswa::where('status', 'buka')->count(),
            'countPengajuan' => Pendaftaran::where('mahasiswa_id', $mahasiswaId)->count(),
            'lastStatus'     => Pendaftaran::where('mahasiswa_id', $mahasiswaId)->latest()->first()->status ?? 'belum_daftar',
            'chartLabels'    => $tren->pluck('bulan')->toArray(),
            'chartData'      => $tren->pluck('total')->toArray()
        ];
    }

    private function getMonthlyTrend()
    {
        return Pendaftaran::select(DB::raw('COUNT(*) as total'), DB::raw("DATE_FORMAT(created_at, '%b') as bulan"))
            ->whereYear('created_at', date('Y'))
            ->groupBy('bulan', DB::raw("MONTH(created_at)"))
            ->orderBy(DB::raw("MONTH(created_at)"), 'ASC')
            ->get();
    }

    private function getFacultyDistribution()
    {
        return DB::table('pendaftaran')
            ->join('mahasiswa', 'pendaftaran.mahasiswa_id', '=', 'mahasiswa.id')
            ->join('prodi', 'mahasiswa.prodi_id', '=', 'prodi.id')
            ->select('prodi.fakultas', DB::raw('COUNT(pendaftaran.id) as total'))
            ->groupBy('prodi.fakultas')
            ->get();
    }
}