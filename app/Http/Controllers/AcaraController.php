<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use Illuminate\Http\Request;

class AcaraController extends Controller
{
    public function index()
    {
        $acaras = Acara::orderBy('tanggal_acara', 'asc')->get();
        return view('acara.index', compact('acaras'));
    }

    public function create()
    {
        return view('acara.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'tanggal_acara' => 'required|date',
            'waktu' => 'nullable|string',
            'lokasi' => 'nullable|string',
            'deskripsi' => 'nullable|string',
        ]);
        Acara::create($request->all());
        return redirect()->route('acara.index')->with('success', 'Acara ditambahkan.');
    }

    public function edit($id)
    {
        $acara = Acara::findOrFail($id);
        return view('acara.edit', compact('acara'));
    }

    public function update(Request $request, $id)
    {
        $acara = Acara::findOrFail($id);
        $request->validate([
            'judul' => 'required|string',
            'tanggal_acara' => 'required|date',
            'waktu' => 'nullable|string',
            'lokasi' => 'nullable|string',
            'deskripsi' => 'nullable|string',
        ]);
        $acara->update($request->all());
        return redirect()->route('acara.index')->with('success', 'Acara diperbarui.');
    }

    public function destroy($id)
    {
        Acara::findOrFail($id)->delete();
        return redirect()->route('acara.index')->with('success', 'Acara dihapus.');
    }
}