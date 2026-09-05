<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Jadwal Jumat</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #f4f6f9; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 20px auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h1 { color: #2c662d; margin-top: 0; text-align: center; border-bottom: 2px solid #2c662d; padding-bottom: 10px; }
        label { display: block; margin: 15px 0 5px; font-weight: 600; color: #444; }
        input, select { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; font-size: 14px; }
        .actions { display: flex; gap: 10px; margin-top: 25px; }
        .btn { padding: 12px 24px; border-radius: 6px; text-decoration: none; border: none; cursor: pointer; font-weight: 600; flex: 1; text-align: center; }
        .btn-primary { background: #2c662d; color: white; }
        .btn-secondary { background: #6c757d; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Jadwal Jumat</h1>
        <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
            @csrf @method('PUT')
            <label>Tanggal Jumat</label>
            <input type="date" name="tanggal_jumat" value="{{ $jadwal->tanggal_jumat }}" required>

            <label>Khatib</label>
            <select name="khatib_id" required>
                @foreach($khatibs as $k)
                    <option value="{{ $k->id }}" {{ $jadwal->khatib_id == $k->id ? 'selected' : '' }}>{{ $k->nama_petugas }} ({{ $k->peran_utama }})</option>
                @endforeach
            </select>

            <label>Imam</label>
            <select name="imam_id">
                <option value="">-- Pilih Imam --</option>
                @foreach($imams as $m)
                    <option value="{{ $m->id }}" {{ $jadwal->imam_id == $m->id ? 'selected' : '' }}>{{ $m->nama_petugas }} ({{ $m->peran_utama }})</option>
                @endforeach
            </select>

            <label>Bilal / Muadzin</label>
            <select name="bilal_id">
                <option value="">-- Pilih Bilal --</option>
                @foreach($bilals as $b)
                    <option value="{{ $b->id }}" {{ $jadwal->bilal_id == $b->id ? 'selected' : '' }}>{{ $b->nama_petugas }}</option>
                @endforeach
            </select>

            <label>Tema / Judul Khutbah</label>
            <input type="text" name="tema" value="{{ $jadwal->tema }}">

            <div class="actions">
                <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update Jadwal</button>
            </div>
        </form>
    </div>
</body>
</html>