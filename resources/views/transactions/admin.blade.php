<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Transaksi - Admin</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f4f6f9; }
        .nav { background: #2c662d; padding: 12px 20px; display: flex; gap: 15px; }
        .nav a { color: white; text-decoration: none; padding: 8px 16px; border-radius: 4px; }
        .nav a.active { background: rgba(255,255,255,0.2); }
        .container { max-width: 1100px; margin: 20px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h1 { color: #2c662d; text-align: center; }
        .actions { margin: 15px 0; }
        .btn { padding: 8px 15px; text-decoration: none; border-radius: 4px; color: white; display: inline-block; border: none; cursor: pointer; }
        .btn-primary { background: #007bff; }
        .btn-success { background: #28a745; }
        .btn-warning { background: #ffc107; color: #333; }
        .btn-danger { background: #dc3545; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background: #2c662d; color: white; }
        .alert { background: #d4edda; color: #155724; padding: 12px; border-radius: 4px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="nav">
        <a href="{{ route('transactions.index') }}">Dashboard Warga</a>
        <a href="{{ route('transactions.admin') }}" class="active">Kelola Data</a>
    </div>
    <div class="container">
        <h1>Kelola Transaksi - Masjid Nurul Qolbi</h1>
        
        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <div class="actions">
            <a href="{{ route('transactions.create') }}" class="btn btn-primary">+ Tambah Transaksi</a>
        </div>

        @if($transactions->isEmpty())
            <div class="alert">Tidak ada data transaksi.</div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Deskripsi</th>
                        <th>Pemasukan</th>
                        <th>Pengeluaran</th>
                        <th>Saldo</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $i => $t)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d/m/Y') }}</td>
                        <td>{{ $t->deskripsi }}</td>
                        <td>Rp {{ number_format($t->pemasukan, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($t->pengeluaran, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($t->saldo, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('transactions.edit', $t->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('transactions.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
