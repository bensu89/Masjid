<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    @include('partials.style')
    <style>
        .container { max-width: 500px; }
        .saldo-box { background:#d4edda;color:#155724;padding:15px;border-radius:6px;margin-bottom:20px;text-align:center;font-weight:bold;font-size:18px; }
        .error { color: #dc3545; font-size: 12px; margin-top: 4px; }
    </style>
</head>
<body>
    @include('partials.nav')
    <div class="container">
        <h1>Tambah Transaksi - Masjid Nurul Qolbi</h1>
        <div class="saldo-box">Saldo Saat Ini: Rp {{ number_format($saldo, 0, ',', '.') }}</div>
        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf
            <label>Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
            @error('tanggal')<div class="error">{{ $message }}</div>@enderror

            <label>Deskripsi</label>
            <textarea name="deskripsi" rows="3" required>{{ old('deskripsi') }}</textarea>
            @error('deskripsi')<div class="error">{{ $message }}</div>@enderror

            <label>Pemasukan (Rp)</label>
            <input type="number" name="pemasukan" value="{{ old('pemasukan', 0) }}" min="0" required>
            @error('pemasukan')<div class="error">{{ $message }}</div>@enderror

            <label>Pengeluaran (Rp)</label>
            <input type="number" name="pengeluaran" value="{{ old('pengeluaran', 0) }}" min="0" required>
            @error('pengeluaran')<div class="error">{{ $message }}</div>@enderror

            <div class="form-actions">
                <a href="{{ route('transactions.admin') }}" class="btn btn-danger">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>