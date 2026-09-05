<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Khatib;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index() {
        $jadwals = Jadwal::with('khatib')->orderBy('tanggal_jumat')->get();
        return view('jadwal.index', compact('jadwals'));
    }

    public function create() {
        $khatibs = Khatib::where('status_aktif', true)->get(); // Note 2: hanya yang Aktif
        return view('jadwal.create', compact('khatibs'));
    }

    public function store(Request $request) {
        $request->validate([
            'khatib_id' => 'required|exists:khatib,id',
            'tanggal_jumat' => 'required|date',
            'tema' => 'nullable|string',
        ]);
        Jadwal::create($request->all());
        return redirect()->route('jadwal.index')->with('success', 'Jadwal disimpan.');
    }

    public function edit($id) {
        $jadwal = Jadwal::findOrFail($id);
        $khatibs = Khatib::where('status_aktif', true)->get();
        return view('jadwal.edit', compact('jadwal', 'khatibs'));
    }

    public function update(Request $request, $id) {
        $jadwal = Jadwal::findOrFail($id);
        $request->validate(['khatib_id' => 'required', 'tanggal_jumat' => 'required|date']);
        $jadwal->update($request->all());
        return redirect()->route('jadwal.index')->with('success', 'Jadwal diperbarui.');
    }

    public function destroy($id) {
        Jadwal::findOrFail($id)->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal dihapus.');
    }
}
