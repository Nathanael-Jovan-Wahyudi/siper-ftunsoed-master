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
        // Ambil semua gedung untuk ditampilkan di dashboard
        $gedungs = \App\Models\Gedung::orderBy('nama_gedung')->get();

        // Ambil peminjaman user yang login
        $peminjamans = Peminjaman::where('user_id', Auth::id())
            ->with(['ruangan.gedung', 'details'])
            ->latest()
            ->take(10)
            ->get();

        return view('peminjam.dashboard', compact('gedungs', 'peminjamans'));
    }
}