<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Jadwal;
use App\Models\Acara;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Dashboard publik - warga bisa lihat
    public function index(Request $request)
    {
        $settings = Setting::firstOrCreate([], [
            'jadwal_shalat_jumat_enabled' => true,
            'acara_keagamaan_enabled' => true,
            'laporan_keuangan_enabled' => true,
        ]);

        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        $query = Transaction::query();
        if ($bulan) $query->whereMonth('tanggal', $bulan);
        if ($tahun) $query->whereYear('tanggal', $tahun);

        $transactions = (clone $query)->orderBy('tanggal', 'desc')->orderBy('id', 'desc')->get();
        $totalPemasukan = (clone $query)->sum('pemasukan');
        $totalPengeluaran = (clone $query)->sum('pengeluaran');
        $saldoAkhir = Transaction::sum('pemasukan') - Transaction::sum('pengeluaran');

        $tahunQuery = DB::connection()->getDriverName() === 'sqlite' 
            ? "CAST(strftime('%Y', tanggal) AS INTEGER) as tahun" 
            : 'YEAR(tanggal) as tahun';
        $availableTahuns = Transaction::selectRaw($tahunQuery)->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        $jadwals = $settings->jadwal_shalat_jumat_enabled 
            ? Jadwal::with(['khatib', 'imam', 'bilal'])->where('tanggal_jumat', '>=', \Carbon\Carbon::today())->orderBy('tanggal_jumat', 'asc')->get()
            : collect([]);

        $acaras = $settings->acara_keagamaan_enabled
            ? Acara::where('tanggal_acara', '>=', \Carbon\Carbon::today())->orderBy('tanggal_acara', 'asc')->get()
            : collect([]);

        $shalat = null;
        try {
            $response = \Illuminate\Support\Facades\Http::post('https://equran.id/api/v2/shalat', [
                'provinsi' => 'Jawa Barat',
                'kabkota' => 'Kab. Sumedang'
            ]);
            $data = $response->json();
            $hariIni = (int)\Carbon\Carbon::now()->format('d');
            $shalat = collect($data['data']['jadwal'] ?? [])->firstWhere('tanggal', $hariIni);
        } catch (\Exception $e) {}

        return view('transactions.index', compact('transactions', 'totalPemasukan', 'totalPengeluaran', 'saldoAkhir', 'jadwals', 'shalat', 'acaras', 'bulan', 'tahun', 'availableTahuns', 'settings'));
    }

    // Halaman khusus Admin (kelola data)
    public function adminIndex(Request $request)
    {
        $settings = Setting::firstOrCreate([], [
            'jadwal_shalat_jumat_enabled' => true,
            'acara_keagamaan_enabled' => true,
            'laporan_keuangan_enabled' => true,
        ]);

        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        $query = Transaction::query();
        if ($bulan) $query->whereMonth('tanggal', $bulan);
        if ($tahun) $query->whereYear('tanggal', $tahun);

        $transactions = (clone $query)->orderBy('tanggal', 'desc')->orderBy('id', 'desc')->get();
        $totalPemasukan = (clone $query)->sum('pemasukan');
        $totalPengeluaran = (clone $query)->sum('pengeluaran');
        $saldoAkhir = Transaction::sum('pemasukan') - Transaction::sum('pengeluaran');

        $tahunQuery = DB::connection()->getDriverName() === 'sqlite' 
            ? "CAST(strftime('%Y', tanggal) AS INTEGER) as tahun" 
            : 'YEAR(tanggal) as tahun';
        $availableTahuns = Transaction::selectRaw($tahunQuery)->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        return view('transactions.admin', compact('transactions', 'totalPemasukan', 'totalPengeluaran', 'saldoAkhir', 'bulan', 'tahun', 'availableTahuns', 'settings'));
    }

    public function updateSettings(Request $request)
    {
        $settings = Setting::first();
        $settings->update([
            'jadwal_shalat_jumat_enabled' => $request->has('jadwal_shalat_jumat_enabled'),
            'acara_keagamaan_enabled' => $request->has('acara_keagamaan_enabled'),
            'laporan_keuangan_enabled' => $request->has('laporan_keuangan_enabled'),
        ]);

        return redirect()->back()->with('success', 'Pengaturan fitur berhasil diperbarui!');
    }

    // Form tambah transaksi (admin)
    public function create()
    {
        $last = Transaction::orderBy('id', 'desc')->first();
        $saldo = $last ? $last->saldo : 0;
        return view('transactions.create', compact('saldo'));
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

        return redirect()->route('transactions.create')->with('success', 'Transaksi berhasil ditambahkan!');
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

        return redirect()->route('transactions.admin')->with('success', 'Transaksi berhasil diperbarui!');
    }

    // Hapus transaksi
    public function destroy($id)
    {
        Transaction::findOrFail($id)->delete();
        $this->recalculateSaldo();

        return redirect()->route('transactions.admin')->with('success', 'Transaksi berhasil dihapus!');
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