<?php

namespace App\Http\Controllers;

use App\Models\PetugasJumat;
use Illuminate\Http\Request;

class PetugasJumatController extends Controller
{
    public function index(Request $request)
    {
        $query = PetugasJumat::orderBy('nama_petugas');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where('nama_petugas', 'like', "%$s%");
        }

        if ($request->filled('peran')) {
            $query->where('peran_utama', $request->peran);
        }

        $petugas = $query->get();
        return view('petugas_jumat.index', compact('petugas'));
    }

    public function create()
    {
        return view('petugas_jumat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_petugas' => 'required|string|max:150',
            'peran_utama' => 'nullable|in:Khatib,Imam,Bilal',
            'no_whatsapp' => 'required|string|max:20',
            'domisili' => 'nullable|string',
            'status_aktif' => 'boolean',
        ]);

        $validated['no_whatsapp'] = $this->formatWa($validated['no_whatsapp']);
        $validated['status_aktif'] = $request->has('status_aktif');
        PetugasJumat::create($validated);

        return redirect()->route('petugas_jumat.index')->with('success', 'Petugas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $petugas = PetugasJumat::findOrFail($id);
        return view('petugas_jumat.edit', compact('petugas'));
    }

    public function update(Request $request, $id)
    {
        $petugas = PetugasJumat::findOrFail($id);

        $validated = $request->validate([
            'nama_petugas' => 'required|string|max:150',
            'peran_utama' => 'nullable|in:Khatib,Imam,Bilal',
            'no_whatsapp' => 'required|string|max:20',
            'domisili' => 'nullable|string',
        ]);

        $validated['no_whatsapp'] = $this->formatWa($validated['no_whatsapp']);
        $validated['status_aktif'] = $request->has('status_aktif');
        $petugas->update($validated);

        return redirect()->route('petugas_jumat.index')->with('success', 'Data petugas diperbarui.');
    }

    public function destroy($id)
    {
        PetugasJumat::findOrFail($id)->delete();
        return redirect()->route('petugas_jumat.index')->with('success', 'Petugas dihapus.');
    }

    private function formatWa($number)
    {
        $number = preg_replace('/[^0-9]/', '', $number);
        if (str_starts_with($number, '0')) {
            $number = '62' . substr($number, 1);
        } elseif (!str_starts_with($number, '62')) {
            $number = '62' . $number;
        }
        return $number;
    }
}
