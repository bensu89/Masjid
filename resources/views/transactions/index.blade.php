<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keuangan Masjid Nurul Qolbi</title>
    @include('partials.style')
    <style>
        .summary { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 15px; margin: 20px 0; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center; }
        .card.income { border-top: 4px solid #28a745; }
        .card.expense { border-top: 4px solid #dc3545; }
        .card.balance { border-top: 4px solid #007bff; }
        .card h3 { margin: 0; color: #555; }
        .card .amount { font-size: 24px; font-weight: bold; margin-top: 10px; word-break: break-word; }
        .income .amount { color: #28a745; }
        .expense .amount { color: #dc3545; }
        .balance .amount { color: #007bff; }
        .ticker { background:#2c662d; color:white; overflow:hidden; white-space:nowrap; padding:10px; border-radius:6px; margin-bottom:20px; }
        @media (max-width: 768px) {
            .summary { grid-template-columns: 1fr; }
            .card .amount { font-size: 20px; }
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
        <div style="text-align:center; margin-bottom:20px;">
            <img src="{{ asset('images/mosque.png') }}" alt="Icon Masjid" style="width:120px; margin-bottom:10px;">
            <h1>Dashboard Masjid Nurul Qolbi</h1>
        </div>

        @if($settings->jadwal_shalat_jumat_enabled)
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
        @endif

        @if($settings->jadwal_pengajian_enabled)
        <h2 style="color:#2c662d; font-size:20px; border-bottom:2px solid #2c662d; padding-bottom:8px; margin-top:30px;">Jadwal Pengajian</h2>
        @if($pengajians->isNotEmpty())
            <table style="margin-bottom:30px;">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Pemateri</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Lokasi</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengajians as $p)
                    <tr>
                        <td>{{ $p->judul }}</td>
                        <td>{{ $p->pemateri }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</td>
                        <td>{{ $p->waktu ?: '-' }}</td>
                        <td>{{ $p->lokasi ?: '-' }}</td>
                        <td>{{ $p->deskripsi ?: '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty" style="margin-bottom:30px;">Belum ada jadwal pengajian.</div>
        @endif
        @endif

        @if($settings->laporan_keuangan_enabled)
        <h2 style="color:#2c662d; font-size:20px; border-bottom:2px solid #2c662d; padding-bottom:8px; margin-top:30px;">Laporan Keuangan</h2>
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

        <div style="text-align:center; margin:20px 0;">
            <button id="toggle-table-btn" type="button" style="background:#2c662d; color:white; border:none; padding:10px 20px; border-radius:6px; cursor:pointer; font-size:14px;">
                {{ request('search') || request('bulan') || request('tahun') || request('all') ? 'Sembunyikan Rincian Transaksi' : 'Lihat Rincian Transaksi' }}
            </button>
        </div>

        <div id="table-container" style="display: {{ request('search') || request('bulan') || request('tahun') || request('all') ? 'block' : 'none' }};">
            <form method="GET" action="{{ route('transactions.index') }}" style="display:flex; gap:10px; flex-wrap:wrap; margin-bottom:15px; align-items:center;">
                <input type="text" name="search" placeholder="Cari transaksi..." value="{{ request('search') }}" style="flex:1; min-width:180px; padding:8px 12px; border:1px solid #ccc; border-radius:6px;">
                <select name="bulan" style="padding:8px 12px; border:1px solid #ccc; border-radius:6px; min-width:130px;">
                    <option value="">Semua Bulan</option>
                    @for($m=1; $m<=12; $m++)
                        <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($m)->locale('id')->isoFormat('MMMM') }}
                        </option>
                    @endfor
                </select>
                <select name="tahun" style="padding:8px 12px; border:1px solid #ccc; border-radius:6px; min-width:110px;">
                    <option value="">Semua Tahun</option>
                    @foreach($availableTahuns as $th)
                        <option value="{{ $th }}" {{ request('tahun') == $th ? 'selected' : '' }}>{{ $th }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary" style="padding:8px 16px;">Filter</button>
                @if(request('search') || request('bulan') || request('tahun') || request('all'))
                    <a href="{{ route('transactions.index') }}" class="btn btn-secondary" style="padding:8px 16px;">Reset</a>
                @else
                    <a href="{{ route('transactions.index', ['all' => 1]) }}" class="btn btn-secondary" style="padding:8px 16px;">Lihat Semua</a>
                @endif
            </form>

            @php
                $displayTransactions = (request('search') || request('bulan') || request('tahun') || request('all')) ? $allTransactions : $recentTransactions;
            @endphp

            @if(!request('search') && !request('bulan') && !request('tahun') && !request('all'))
                <p style="font-size:13px; color:#666; margin-bottom:10px;">* Menampilkan 5 transaksi terakhir. Gunakan pencarian atau klik "Lihat Semua" untuk data lengkap.</p>
            @endif

            @if($displayTransactions->isEmpty())
                <div class="empty">Belum ada data transaksi yang sesuai.</div>
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
                        @foreach($displayTransactions as $i => $t)
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
        </div>
        @endif

        <p style="text-align:center; margin-top:30px; font-size:13px;"><a href="{{ route('login') }}" style="color:#888; text-decoration:none;">Login Admin</a></p>
    </div>

    <script>
        document.getElementById('toggle-table-btn').addEventListener('click', function() {
            var el = document.getElementById('table-container');
            if (el.style.display === 'none') {
                el.style.display = 'block';
                this.innerText = 'Sembunyikan Rincian Transaksi';
            } else {
                el.style.display = 'none';
                this.innerText = 'Lihat Rincian Transaksi';
            }
        });
    </script>
</body>
</html>
