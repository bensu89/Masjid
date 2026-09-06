<?php

namespace App\Http\Controllers;

use App\Models\Pengajian;
use Illuminate\Http\Request;

class PengajianController extends Controller
{
    public function index()
    {
        $pengajian = Pengajian::orderBy('tanggal', 'asc')->get();
        return view('pengajian.index', compact('pengajian'));
    }

    public function create()
    {
        return view('pengajian.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'pemateri' => 'required|string',
            'tanggal' => 'required|date',
            'waktu' => 'nullable|string',
            'lokasi' => 'nullable|string',
            'deskripsi' => 'nullable|string',
        ]);

        Pengajian::create($request->all());

        return redirect()->route('pengajian.index')->with('success', 'Jadwal pengajian ditambahkan.');
    }

    public function edit($id)
    {
        $pengajian = Pengajian::findOrFail($id);
        return view('pengajian.edit', compact('pengajian'));
    }

    public function update(Request $request, $id)
    {
        $pengajian = Pengajian::findOrFail($id);

        $request->validate([
            'judul' => 'required|string',
            'pemateri' => 'required|string',
            'tanggal' => 'required|date',
            'waktu' => 'nullable|string',
            'lokasi' => 'nullable|string',
            'deskripsi' => 'nullable|string',
        ]);

        $pengajian->update($request->all());

        return redirect()->route('pengajian.index')->with('success', 'Jadwal pengajian diperbarui.');
    }

    public function destroy($id)
    {
        Pengajian::findOrFail($id)->delete();
        return redirect()->route('pengajian.index')->with('success', 'Jadwal pengajian dihapus.');
    }
}