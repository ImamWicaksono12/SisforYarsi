<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    /**
     */
    public function index()
    {
        $stats = $this->dashboardService->getAdminStats();

        return view('dashboard.admin', [
            'totalBeasiswa' => $stats['widgets']['totalBeasiswa'],
            'pendaftarAktif' => $stats['widgets']['pendaftarAktif'],
            'menungguValidasi' => $stats['widgets']['menungguValidasi'],
            'totalDiterima' => $stats['widgets']['totalDiterima'],
            'trenPendaftaran' => $stats['tren'],
            'distribusiFakultas' => $stats['distribusiFakultas'],
            'pendaftaranTerbaru' => $stats['terbaru']
        ]);
    }

    /**
     */
    public function mahasiswaIndex()
    {
        $user = Auth::user();

        if (!$user || !$user->mahasiswa) {
            return redirect()->route('home')->with('error', 'Profil mahasiswa belum ditemukan.');
        }

        $stats = $this->dashboardService->getMahasiswaStats($user->mahasiswa);

        return view('dashboard.mahasiswa', $stats);
    }

    public function kaprodiIndex()
    {
        $stats = $this->dashboardService->getAdminStats();

        return view('dashboard.kaprodi', $stats);
    }
}