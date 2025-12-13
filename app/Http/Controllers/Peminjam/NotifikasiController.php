<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifikasis = \App\Models\Notifikasi::where('user_id', \Auth::id())
            ->orderBy('waktu_kirim', 'desc')
            ->get();
        return view('peminjam.notifikasi.index', compact('notifikasis'));
    }
}
