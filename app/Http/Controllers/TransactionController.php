<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Dashboard publik - warga bisa lihat
    public function index()
    {
        $transactions = Transaction::orderBy('tanggal', 'desc')->orderBy('id', 'desc')->get();
        $totalPemasukan = Transaction::sum('pemasukan');
        $totalPengeluaran = Transaction::sum('pengeluaran');
        $saldoAkhir = $totalPemasukan - $totalPengeluaran;

        return view('transactions.index', compact('transactions', 'totalPemasukan', 'totalPengeluaran', 'saldoAkhir'));
    }

    // Halaman khusus Admin (kelola data)
    public function adminIndex()
    {
        $transactions = Transaction::orderBy('tanggal', 'desc')->orderBy('id', 'desc')->get();
        $totalPemasukan = Transaction::sum('pemasukan');
        $totalPengeluaran = Transaction::sum('pengeluaran');
        $saldoAkhir = $totalPemasukan - $totalPengeluaran;

        return view('transactions.admin', compact('transactions', 'totalPemasukan', 'totalPengeluaran', 'saldoAkhir'));
    }

    // Form tambah transaksi (admin)
    public function create()
    {
        return view('transactions.create');
    }

    // Simpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'pemasukan' => 'required|numeric|min:0',
            'pengeluaran' => 'required|numeric|min:0',
        ]);

        // Hitung saldo otomatis
        $lastTransaction = Transaction::orderBy('id', 'desc')->first();
        $saldoSebelumnya = $lastTransaction ? $lastTransaction->saldo : 0;
        $saldo = $saldoSebelumnya + $request->pemasukan - $request->pengeluaran;

        Transaction::create([
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'pemasukan' => $request->pemasukan,
            'pengeluaran' => $request->pengeluaran,
            'saldo' => $saldo,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    // Form edit transaksi (admin)
    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('transactions.edit', compact('transaction'));
    }

    // Update transaksi
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'pemasukan' => 'required|numeric|min:0',
            'pengeluaran' => 'required|numeric|min:0',
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->update([
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'pemasukan' => $request->pemasukan,
            'pengeluaran' => $request->pengeluaran,
        ]);

        // Recalculate all saldos from this point forward
        $this->recalculateSaldo();

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    // Hapus transaksi
    public function destroy($id)
    {
        Transaction::findOrFail($id)->delete();
        $this->recalculateSaldo();

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus!');
    }

    // Recalculate saldo otomatis
    private function recalculateSaldo()
    {
        $transactions = Transaction::orderBy('id', 'asc')->get();
        $saldo = 0;
        foreach ($transactions as $t) {
            $saldo += $t->pemasukan - $t->pengeluaran;
            $t->update(['saldo' => $saldo]);
        }
    }
}
