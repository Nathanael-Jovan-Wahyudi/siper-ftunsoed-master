<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function dashboard()
    {
        $peminjamans = Peminjaman::where('status', 'pending')
            ->with(['user', 'ruangan.gedung', 'details'])
            ->latest()
            ->get();
        
        // Tambahkan ini untuk data arsip
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