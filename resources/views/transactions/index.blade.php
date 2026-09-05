<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keuangan Masjid Nurul Qolbi</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #e8f5e9; }
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
        @media (max-width: 768px) {
            .container { padding: 15px; }
            h1 { font-size: 20px; }
            .summary { grid-template-columns: 1fr; }
            .card .amount { font-size: 20px; }
            table { font-size: 13px; display: block; overflow-x: auto; white-space: nowrap; }
            th, td { padding: 8px 10px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div style="background:#2c662d; color:white; overflow:hidden; white-space:nowrap; padding:10px; border-radius:6px; margin-bottom:20px;">
            <marquee>
                @if($shalat)
                    Jadwal Shalat Hari Ini (Sumedang): Subuh {{ $shalat['subuh'] }} WIB, Dzuhur {{ $shalat['dzuhur'] }} WIB, Ashar {{ $shalat['ashar'] }} WIB, Maghrib {{ $shalat['maghrib'] }} WIB, Isya {{ $shalat['isya'] }} WIB
                @else
                    Memuat jadwal shalat...
                @endif
            </marquee>
        </div>
        <h1>Dashboard Masjid Nurul Qolbi</h1>

        <h2 style="color:#2c662d; font-size:20px; border-bottom:2px solid #2c662d; padding-bottom:8px; margin-top:30px;">Jadwal Sholat Jumat</h2>
        
        @if($jadwals->isNotEmpty())
            <table style="margin-bottom:20px;">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Khatib</th>
                        <th>Imam</th>
                        <th>Bilal</th>
                        <th>Tema</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jadwals as $j)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($j->tanggal_jumat)->format('d/m/Y') }}</td>
                        <td>{{ $j->khatib->nama_petugas }}</td>
                        <td>{{ $j->imam?->nama_petugas ?: '-' }}</td>
                        <td>{{ $j->bilal?->nama_petugas ?: '-' }}</td>
                        <td>{{ $j->tema ?: '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty" style="margin-bottom:20px;">Belum ada jadwal Jumat.</div>
        @endif

        <h2 style="color:#2c662d; font-size:20px; border-bottom:2px solid #2c662d; padding-bottom:8px; margin-top:30px;">Acara Keagamaan</h2>
        @if($acaras->isNotEmpty())
            <table style="margin-bottom:30px;">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Lokasi</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($acaras as $a)
                    <tr>
                        <td>{{ $a->judul }}</td>
                        <td>{{ \Carbon\Carbon::parse($a->tanggal_acara)->format('d/m/Y') }}</td>
                        <td>{{ $a->waktu ?: '-' }}</td>
                        <td>{{ $a->lokasi ?: '-' }}</td>
                        <td>{{ $a->deskripsi ?: '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty" style="margin-bottom:30px;">Belum ada acara keagamaan.</div>
        @endif

        <h2 style="color:#2c662d; font-size:20px; border-bottom:2px solid #2c662d; padding-bottom:8px; margin-top:30px;">Laporan Keuangan</h2>
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
            <button type="submit" style="padding:8px 16px; background:#2c662d; color:white; border:none; border-radius:4px; cursor:pointer;">Filter</button>
            @if($bulan || $tahun)
                <a href="{{ route('transactions.index') }}" style="padding:8px 16px; background:#6c757d; color:white; text-decoration:none; border-radius:4px;">Reset</a>
            @endif
        </form>
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
