<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Divisi;

class DivisiController extends Controller
{
    public function index()
    {
        // Eager load count untuk optimasi (1 query instead of N+1)
        $divisi = Divisi::withCount('pegawais')->get();
        return view('divisi.index', compact('divisi'));
    }

    public function create()
    {
        return view('divisi.create');
    }

    public function store(Request $r)
    {
        $r->validate([
            'kode' => 'required|unique:divisi,kode',
            'nama' => 'required',
        ], [
            'kode.required' => 'Kode divisi wajib diisi',
            'kode.unique' => 'Kode divisi sudah digunakan',
            'nama.required' => 'Nama divisi wajib diisi',
        ]);

        Divisi::create($r->only(['kode', 'nama']));

        return redirect()
            ->route('divisi.index')
            ->with('success', 'Divisi berhasil ditambahkan');
    }

    public function edit(Divisi $divisi)
    {
        return view('divisi.edit', compact('divisi'));
    }

    public function update(Request $r, Divisi $divisi)
    {
        $r->validate([
            'kode' => 'required|unique:divisi,kode,' . $divisi->id,
            'nama' => 'required',
        ], [
            'kode.required' => 'Kode divisi wajib diisi',
            'kode.unique' => 'Kode divisi sudah digunakan',
            'nama.required' => 'Nama divisi wajib diisi',
        ]);

        $divisi->update($r->only(['kode', 'nama']));

        return redirect()
            ->route('divisi.index')
            ->with('success', 'Divisi berhasil diperbarui');
    }

    public function destroy(Divisi $divisi)
    {
        $divisi->delete();

        return redirect()
            ->route('divisi.index')
            ->with('success', 'Divisi berhasil dihapus');
    }
}
