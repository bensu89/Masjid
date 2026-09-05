<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Khatib - Masjid Nurul Qolbi</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: Arial; background: #e8f5e9; margin: 0; }
        .nav { background: #2c662d; padding: 12px 20px; display: flex; gap: 15px; flex-wrap: wrap; }
        .nav a { color: white; text-decoration: none; padding: 8px 16px; border-radius: 4px; }
        .nav a.active { background: rgba(255,255,255,0.25); font-weight: bold; }
        .nav a.logout { margin-left: auto; background: rgba(220,53,69,0.6); }
        .container { max-width: 1000px; margin: 20px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h1 { color: #2c662d; text-align: center; }
        .alert { background: #d4edda; color: #155724; padding: 12px; border-radius: 4px; margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #2c662d; color: white; }
        .btn { padding: 6px 12px; border-radius: 4px; text-decoration: none; color: white; display: inline-block; border: none; cursor: pointer; }
        .btn-primary { background: #007bff; }
        .btn-warning { background: #ffc107; color: #333; }
        .btn-danger { background: #dc3545; }
        .search-box { margin: 15px 0; }
        .search-box input { padding: 8px; width: 300px; border: 1px solid #ddd; border-radius: 4px; }
        .status-aktif { color: green; font-weight: bold; }
        .status-istirahat { color: #999; }
        .action-btns { display: flex; gap: 5px; }
    </style>
</head>
<body>
    @include('partials.nav')
    <div class="container">
        <h1>Data Khatib - Masjid Nurul Qolbi</h1>
        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <a href="{{ route('khatib.create') }}" class="btn btn-primary">+ Tambah Khatib</a>

        <div class="search-box">
            <form action="{{ route('khatib.index') }}" method="GET">
                <input type="text" name="search" placeholder="Cari nama / domisili..." value="{{ request('search') }}">
            </form>
        </div>

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
                @forelse($khatibs as $i => $k)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $k->nama_khatib }}</td>
                    <td>{{ $k->no_whatsapp }}</td>
                    <td>{{ $k->domisili }}</td>
                    <td>
                        @if($k->status_aktif)
                            <span class="status-aktif">Aktif</span>
                        @else
                            <span class="status-istirahat">Istirahat</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('khatib.edit', $k->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('khatib.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Hapus khatib?')">
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