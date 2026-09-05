<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Transaksi - Admin</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #e8f5e9; }
        .nav { background: #2c662d; padding: 12px 20px; display: flex; gap: 15px; flex-wrap: wrap; }
        .nav a { color: white; text-decoration: none; padding: 8px 16px; border-radius: 4px; }
        .nav a.active { background: rgba(255,255,255,0.25); font-weight: bold; }
        .nav a.logout { margin-left: auto; background: rgba(220,53,69,0.6); }
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
        .action-btns { display: flex; gap: 5px; }
        @media (max-width: 768px) {
            .container { padding: 15px; }
            h1 { font-size: 20px; }
            .nav { flex-wrap: wrap; }
            table { font-size: 12px; display: block; overflow-x: auto; white-space: nowrap; }
            th, td { padding: 8px 10px; }
            .btn { padding: 6px 10px; font-size: 12px; }
        }
    </style>
</head>
<body>
    @include('partials.nav')
    <div class="container">
        <h1>Kelola Transaksi - Masjid Nurul Qolbi</h1>
        
        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <div class="actions">
            <a href="{{ route('transactions.create') }}" class="btn btn-primary">+ Tambah Transaksi</a>
        </div>

        <form method="GET" style="display:flex; gap:10px; margin:15px 0;">
            <select name="bulan" style="padding:8px; border:1px solid #ddd; border-radius:4px;">
                <option value="">-- Semua Bulan --</option>
                @for($i=1;$i<=12;$i++)
                    <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}</option>
                @endfor
            </select>
            <select name="tahun" style="padding:8px; border:1px solid #ddd; border-radius:4px;">
                <option value="">-- Semua Tahun --</option>
                @foreach($availableTahuns as $t)
                    <option value="{{ $t }}" {{ $tahun == $t ? 'selected' : '' }}>{{ $t }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
            @if($bulan || $tahun)
                <a href="{{ route('transactions.admin') }}" class="btn btn-success" style="background:#6c757d;">Reset</a>
            @endif
        </form>

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
                            <div class="action-btns">
                                <a href="{{ route('transactions.edit', $t->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('transactions.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
