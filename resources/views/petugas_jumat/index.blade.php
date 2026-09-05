<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Petugas Jumat</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #f4f6f9; margin: 0; }
        .nav { background: #2c662d; padding: 12px 20px; display: flex; gap: 15px; flex-wrap: wrap; }
        .nav a { color: white; text-decoration: none; padding: 8px 16px; border-radius: 4px; }
        .nav a.active { background: rgba(255,255,255,0.25); font-weight: bold; }
        .nav a.logout { margin-left: auto; background: rgba(220,53,69,0.6); }
        .container { max-width: 1100px; margin: 20px auto; padding: 20px; background: white; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h1 { color: #2c662d; text-align: center; }
        .alert { background: #d4edda; color: #155724; padding: 12px; border-radius: 6px; margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #2c662d; color: white; }
        .btn { padding: 6px 12px; border-radius: 6px; text-decoration: none; color: white; display: inline-block; border: none; cursor: pointer; font-weight: 600; }
        .btn-primary { background: #2c662d; }
        .btn-warning { background: #ffc107; color: #333; }
        .btn-danger { background: #dc3545; }
        .filter-box { display:flex; gap:10px; margin:15px 0; }
        .filter-box input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; }
        .badge { padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; }
        .badge-khatib { background: #d4edda; color: #155724; }
        .badge-imam { background: #cce5ff; color: #004085; }
        .badge-bilal { background: #fff3cd; color: #856404; }
        .action-btns { display: flex; gap: 5px; }
    </style>
</head>
<body>
    @include('partials.nav')
    <div class="container">
        <h1>Data Petugas Jumat - Masjid Nurul Qolbi</h1>
        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <a href="{{ route('petugas_jumat.create') }}" class="btn btn-primary">+ Tambah Petugas</a>

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
    </div>
</body>
</html>