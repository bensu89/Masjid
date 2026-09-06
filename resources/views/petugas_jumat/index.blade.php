<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Petugas Jumat</title>
    @include('partials.style')
    <style>
        .filter-box { display:flex; gap:10px; margin:15px 0; }
        .filter-box input { width: 100%; }
        .badge { padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; }
        .badge-khatib { background: #d4edda; color: #155724; }
        .badge-imam { background: #cce5ff; color: #004085; }
        .badge-bilal { background: #fff3cd; color: #856404; }
        @media (max-width: 768px) {
            .filter-box { flex-direction: column; }
        }
    </style>
</head>
<body>
    @include('partials.nav')
    <div class="container">
        <h1>Data Petugas Jumat - Masjid Nurul Qolbi</h1>
        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <div style="display:flex; gap:10px; flex-wrap:wrap; margin-bottom:15px;">
            <a href="{{ route('petugas_jumat.create') }}" class="btn btn-primary">+ Tambah Petugas</a>
        </div>

        <form action="{{ route('petugas_jumat.index') }}" method="GET" class="filter-box">
            <input type="text" name="search" placeholder="Cari nama petugas..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>No. WhatsApp</th>
                    <th>Domisili</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($petugas as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $p->nama_petugas }}</td>
                    <td>{{ $p->no_whatsapp }}</td>
                    <td>{{ $p->domisili }}</td>
                    <td>
                        @if($p->status_aktif)
                            <span style="color:green;font-weight:bold;">Aktif</span>
                        @else
                            <span style="color:#999;">Istirahat</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('petugas_jumat.edit', $p->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('petugas_jumat.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger" type="submit">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;color:#999;">Tidak ada data.</td></tr>
                @endforelse
            </tbody>
        </table>

        <h2 style="color:#2c662d; margin-top:35px; border-bottom:2px solid #2c662d; padding-bottom:8px;">Jadwal Jumat</h2>
        <div style="margin-bottom:10px;">
            <a href="{{ route('jadwal.create') }}" class="btn btn-primary">+ Tambah Jadwal Jumat</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Khatib</th>
                    <th>Imam</th>
                    <th>Bilal</th>
                    <th>Tema</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jadwals as $i => $j)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($j->tanggal_jumat)->format('d/m/Y') }}</td>
                    <td>{{ $j->khatib->nama_petugas }}</td>
                    <td>{{ $j->imam?->nama_petugas ?: '-' }}</td>
                    <td>{{ $j->bilal?->nama_petugas ?: '-' }}</td>
                    <td>{{ $j->tema ?: '-' }}</td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('jadwal.edit', $j->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('jadwal.destroy', $j->id) }}" method="POST" onsubmit="return confirm('Hapus jadwal?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger" type="submit">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center;color:#999;">Belum ada jadwal.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>