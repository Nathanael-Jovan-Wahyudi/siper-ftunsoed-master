<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Gedung;
use Illuminate\Http\Request;

class GedungController extends Controller
{
    public function index()
    {
        $gedungs = Gedung::orderBy('nama_gedung')->get();
        return view('peminjam.gedung.index', compact('gedungs'));
    }
}
