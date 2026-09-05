<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Acara Keagamaan</title>
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
        .btn { padding: 6px 12px; border-radius: 6px; text-decoration: none; color: white; display: inline-block; border: none; cursor: pointer; }
        .btn-primary { background: #2c662d; }
        .btn-warning { background: #ffc107; color: #333; }
        .btn-danger { background: #dc3545; }
        .action-btns { display: flex; gap: 5px; }
    </style>
</head>
<body>
    @include('partials.nav')
    <div class="container">
        <h1>Acara Keagamaan - Masjid Nurul Qolbi</h1>
        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <a href="{{ route('acara.create') }}" class="btn btn-primary">+ Tambah Acara</a>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Lokasi</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($acaras as $i => $a)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $a->judul }}</td>
                    <td>{{ \Carbon\Carbon::parse($a->tanggal_acara)->format('d/m/Y') }}</td>
                    <td>{{ $a->waktu ?: '-' }}</td>
                    <td>{{ $a->lokasi ?: '-' }}</td>
                    <td>{{ $a->deskripsi ?: '-' }}</td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('acara.edit', $a->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('acara.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Hapus acara?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger" type="submit">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center;color:#999;">Belum ada acara.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>