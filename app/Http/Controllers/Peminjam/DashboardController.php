<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Ruangan;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Semua ruangan yang sedang dipinjam/di-ACC (untuk tab "Ruangan Dipinjam")
        $ruanganDipinjam = Peminjaman::with(['ruangan.gedung', 'details'])
            ->whereIn('status', ['disetujui subkoor', 'disetujui bapendik', 'dipinjam'])
            ->orderBy('tanggal_peminjaman', 'asc')
            ->get();

        // Riwayat peminjaman milik user login (untuk tab "Riwayat Pinjaman")
        $riwayatPeminjaman = Peminjaman::with(['ruangan.gedung', 'details'])
            ->where('user_id', Auth::id())
            ->orderByDesc('tanggal_peminjaman')
            ->get();

        return view('peminjam.dashboard', compact('ruanganDipinjam', 'riwayatPeminjaman'));
    }
}