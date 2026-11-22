<?php

namespace App\Http\Controllers;

use App\Models\Zonasi;
use Illuminate\Http\Request;

class ZonasiController extends Controller
{
    public function index()
    {
        $data_rak = Zonasi::orderBy('id', 'asc')->get();
        return view('zonasi.index', compact('data_rak'));
    }

    public function create()
    {
        if (auth()->check() && !in_array(auth()->user()->role, ['admin', 'staff'])) {
            abort(403, 'Akses ditolak: Role Anda hanya memiliki akses baca (View-Only).');
        }

        $edit_data = null;
        return view('zonasi.form', compact('edit_data'));
    }

    public function store(Request $request)
    {
        if (auth()->check() && !in_array(auth()->user()->role, ['admin', 'staff'])) {
            abort(403, 'Akses ditolak: Role Anda hanya memiliki akses baca (View-Only).');
        }

        $validated = $request->validate([
            'zona'         => 'required|string|max:100',
            'nomor_lorong' => 'required|string|max:50',
            'kode_rak'     => 'required|string|max:50',
            'kapasitas'    => 'required|numeric|min:1',
        ]);

        Zonasi::create($validated);

        return redirect()->route('zonasi.index')->with('success', 'Data rak berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        if (auth()->check() && !in_array(auth()->user()->role, ['admin', 'staff'])) {
            abort(403, 'Akses ditolak: Role Anda hanya memiliki akses baca (View-Only).');
        }

        $edit_data = Zonasi::findOrFail($id);
        return view('zonasi.form', compact('edit_data'));
    }

    public function update(Request $request, string $id)
    {
        if (auth()->check() && !in_array(auth()->user()->role, ['admin', 'staff'])) {
            abort(403, 'Akses ditolak: Role Anda hanya memiliki akses baca (View-Only).');
        }

        $validated = $request->validate([
            'zona'         => 'required|string|max:100',
            'nomor_lorong' => 'required|string|max:50',
            'kode_rak'     => 'required|string|max:50',
            'kapasitas'    => 'required|numeric|min:1',
        ]);

        $rak = Zonasi::findOrFail($id);
        $rak->update($validated);

        return redirect()->route('zonasi.index')->with('success', 'Data rak berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak: Hanya Admin yang dapat menghapus data rak.');
        }

        $rak = Zonasi::findOrFail($id);
        $rak->delete();

        return redirect()->route('zonasi.index')->with('success', 'Data rak berhasil dihapus!');
    }
}
