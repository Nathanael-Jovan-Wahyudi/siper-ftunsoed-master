<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil peminjaman yang perlu approval Bapendik
        $peminjamans = Peminjaman::whereIn('status', ['pending', 'diajukan'])
            ->with(['user', 'ruangan.gedung', 'details'])
            ->latest()
            ->get();

        // Ambil arsip peminjaman
        $archives = Peminjaman::whereIn('status', [
            'disetujui bapendik',
            'ditolak bapendik',
            'disetujui' // status final untuk Kuliah Pengganti
        ])
            ->with(['user', 'ruangan.gedung'])
            ->latest()
            ->get();

        return view('admin.dashboard', compact('peminjamans', 'archives'));
    }
}