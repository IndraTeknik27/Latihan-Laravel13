<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Divisi;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::with('divisi')->get();
        return view('pegawai.index', compact('pegawai'));
        
    }

    public function create()
    {
        $divisi = Divisi::all();
        return view('pegawai.create', compact('divisi'));
    }

    public function store(Request $r)
    {
        $r->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'divisi_id' => 'required|exists:divisis,id',
        ]);

        Pegawai::create($r->all());

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan.');
    }
}
