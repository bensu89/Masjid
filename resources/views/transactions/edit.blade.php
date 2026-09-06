<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    @include('partials.style')
    <style>
        .container { max-width: 500px; }
        .error { color: #dc3545; font-size: 12px; margin-top: 4px; }
    </style>
</head>
<body>
    @include('partials.nav')
    <div class="container">
        <h1>Edit Transaksi - Masjid Nurul Qolbi</h1>
        <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label>Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal', $transaction->tanggal) }}" required>
            @error('tanggal')<div class="error">{{ $message }}</div>@enderror

            <label>Deskripsi</label>
            <textarea name="deskripsi" rows="3" required>{{ old('deskripsi', $transaction->deskripsi) }}</textarea>
            @error('deskripsi')<div class="error">{{ $message }}</div>@enderror

            <label>Pemasukan (Rp)</label>
            <input type="number" name="pemasukan" value="{{ old('pemasukan', $transaction->pemasukan) }}" min="0" required>
            @error('pemasukan')<div class="error">{{ $message }}</div>@enderror

            <label>Pengeluaran (Rp)</label>
            <input type="number" name="pengeluaran" value="{{ old('pengeluaran', $transaction->pengeluaran) }}" min="0" required>
            @error('pengeluaran')<div class="error">{{ $message }}</div>@enderror

            <div class="form-actions">
                <a href="{{ route('transactions.admin') }}" class="btn btn-danger">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</body>
</html>