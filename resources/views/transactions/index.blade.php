<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keuangan Masjid Nurul Qolbi</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f4f6f9; }
        .nav { background: #2c662d; padding: 12px 20px; display: flex; gap: 15px; }
        .nav a { color: white; text-decoration: none; padding: 8px 16px; border-radius: 4px; }
        .nav a.active { background: rgba(255,255,255,0.2); }
        .container { max-width: 1100px; margin: 20px auto; padding: 20px; }
        h1 { color: #2c662d; text-align: center; }
        .summary { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin: 20px 0; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center; }
        .card.income { border-top: 4px solid #28a745; }
        .card.expense { border-top: 4px solid #dc3545; }
        .card.balance { border-top: 4px solid #007bff; }
        .card h3 { margin: 0; color: #555; }
        .card .amount { font-size: 24px; font-weight: bold; margin-top: 10px; }
        .income .amount { color: #28a745; }
        .expense .amount { color: #dc3545; }
        .balance .amount { color: #007bff; }
        table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #2c662d; color: white; }
        tr:hover { background: #f1f1f1; }
        .empty { text-align: center; padding: 30px; color: #777; background: white; border-radius: 8px; }
        .badge { background: #e8f5e9; color: #2c662d; padding: 6px 12px; border-radius: 20px; font-size: 13px; display: inline-block; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Keuangan Masjid Nurul Qolbi</h1>
        <div class="summary">
            <div class="card income">
                <h3>Total Pemasukan</h3>
                <div class="amount">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
            </div>
            <div class="card expense">
                <h3>Total Pengeluaran</h3>
                <div class="amount">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
            </div>
            <div class="card balance">
                <h3>Saldo Akhir</h3>
                <div class="amount">Rp {{ number_format($saldoAkhir, 0, ',', '.') }}</div>
            </div>
        </div>
        @if($transactions->isEmpty())
            <div class="empty">Belum ada data transaksi.</div>
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
                        <td><b>Rp {{ number_format($t->saldo, 0, ',', '.') }}</b></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <p style="text-align:center; margin-top:30px; font-size:13px;"><a href="{{ route('login') }}" style="color:#888; text-decoration:none;">Login Admin</a></p>
    </div>
</body>
</html>
