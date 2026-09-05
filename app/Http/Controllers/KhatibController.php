<?php

namespace App\Http\Controllers;

use App\Models\Khatib;
use Illuminate\Http\Request;

class KhatibController extends Controller
{
    public function index(Request $request)
    {
        $query = Khatib::orderBy('nama_khatib');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where('nama_khatib', 'like', "%$s%")
                  ->orWhere('domisili', 'like', "%$s%");
        }

        $khatibs = $query->get();
        return view('khatib.index', compact('khatibs'));
    }

    public function create()
    {
        return view('khatib.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_khatib' => 'required|string|max:150',
            'no_whatsapp' => 'required|string|max:20',
            'domisili'   => 'nullable|string',
            'status_aktif' => 'boolean',
        ]);

        $validated['no_whatsapp'] = $this->formatWa($validated['no_whatsapp']);
        $validated['status_aktif'] = $request->has('status_aktif');
        Khatib::create($validated);

        return redirect()->route('khatib.index')->with('success', 'Khatib berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $khatib = Khatib::findOrFail($id);
        return view('khatib.edit', compact('khatib'));
    }

    public function update(Request $request, $id)
    {
        $khatib = Khatib::findOrFail($id);

        $validated = $request->validate([
            'nama_khatib' => 'required|string|max:150',
            'no_whatsapp' => 'required|string|max:20',
            'domisili'   => 'nullable|string',
            'status_aktif' => 'boolean',
        ]);

        $validated['no_whatsapp'] = $this->formatWa($validated['no_whatsapp']);
        $validated['status_aktif'] = $request->has('status_aktif');
        $khatib->update($validated);

        return redirect()->route('khatib.index')->with('success', 'Data khatib diperbarui.');
    }

    public function destroy($id)
    {
        Khatib::findOrFail($id)->delete();
        return redirect()->route('khatib.index')->with('success', 'Khatib dihapus.');
    }

    // Format WA otomatis: 0812... → 62812...
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
