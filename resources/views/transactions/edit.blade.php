<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #e8f5e9; }
        .nav { background: #2c662d; padding: 12px 20px; display: flex; gap: 15px; }
        .nav a { color: white; text-decoration: none; padding: 8px 16px; border-radius: 4px; }
        .nav a.active { background: rgba(255,255,255,0.2); }
        .container { max-width: 500px; margin: 40px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h1 { color: #2c662d; text-align: center; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input, textarea { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; }
        .btn { padding: 10px 20px; text-decoration: none; border-radius: 4px; color: white; display: inline-block; border: none; cursor: pointer; font-size: 14px; margin-top: 20px; }
        .btn-primary { background: #007bff; }
        .btn-secondary { background: #6c757d; }
        .actions { display: flex; gap: 10px; justify-content: center; margin-top: 10px; }
        .error { color: #dc3545; font-size: 12px; }
    </style>
</head>
<body>
    <div class="nav">
        <a href="{{ route('transactions.index') }}">Dashboard Warga</a>
        <a href="{{ route('transactions.admin') }}" class="active">Admin</a>
    </div>
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

            <div class="actions">
                <a href="{{ route('transactions.admin') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</body>
</html>
