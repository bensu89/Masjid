<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\PetugasJumat;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index() {
        $jadwals = Jadwal::with(['khatib', 'imam', 'bilal'])->orderBy('tanggal_jumat')->get();
        return view('jadwal.index', compact('jadwals'));
    }

    public function create() {
        $petugas = PetugasJumat::where('status_aktif', true)->orderBy('nama_petugas')->get();
        return view('jadwal.create', compact('petugas'));
    }

    public function store(Request $request) {
        $request->validate([
            'khatib_id' => 'required|exists:petugas_jumat,id',
            'imam_id' => 'nullable|exists:petugas_jumat,id',
            'bilal_id' => 'nullable|exists:petugas_jumat,id',
            'tanggal_jumat' => 'required|date',
            'tema' => 'nullable|string',
        ]);
        Jadwal::create($request->all());
        return redirect()->route('jadwal.index')->with('success', 'Jadwal disimpan.');
    }

    public function edit($id) {
        $jadwal = Jadwal::findOrFail($id);
        $petugas = PetugasJumat::where('status_aktif', true)->orderBy('nama_petugas')->get();
        return view('jadwal.edit', compact('jadwal', 'petugas'));
    }

    public function update(Request $request, $id) {
        $jadwal = Jadwal::findOrFail($id);
        $request->validate([
            'khatib_id' => 'required',
            'tanggal_jumat' => 'required|date'
        ]);
        $jadwal->update($request->all());
        return redirect()->route('jadwal.index')->with('success', 'Jadwal diperbarui.');
    }

    public function destroy($id) {
        Jadwal::findOrFail($id)->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal dihapus.');
    }
}
