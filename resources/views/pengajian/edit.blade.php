<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Jadwal Pengajian</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #e8f5e9; margin: 0; padding: 20px; }
        .container { max-width: 650px; margin: 20px auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h1 { color: #2c662d; margin-top: 0; text-align: center; border-bottom: 2px solid #2c662d; padding-bottom: 10px; }
        label { display: block; margin: 15px 0 5px; font-weight: 600; color: #444; }
        input, textarea { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; font-size: 14px; }
        .actions { display: flex; gap: 10px; margin-top: 25px; }
        .btn { padding: 12px 24px; border-radius: 6px; text-decoration: none; border: none; cursor: pointer; font-weight: 600; flex: 1; text-align: center; }
        .btn-primary { background: #2c662d; color: white; }
        .btn-secondary { background: #6c757d; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Jadwal Pengajian</h1>
        <form method="POST" action="{{ route('pengajian.update', $pengajian->id) }}">
            @csrf
            @method('PUT')
            <label>Judul Pengajian</label>
            <input type="text" name="judul" value="{{ old('judul', $pengajian->judul) }}" required>

            <label>Pemateri / Ustadz</label>
            <input type="text" name="pemateri" value="{{ old('pemateri', $pengajian->pemateri) }}" required>

            <label>Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal', $pengajian->tanggal) }}" required>

            <label>Waktu</label>
            <input type="text" name="waktu" value="{{ old('waktu', $pengajian->waktu) }}">

            <label>Lokasi</label>
            <input type="text" name="lokasi" value="{{ old('lokasi', $pengajian->lokasi) }}">

            <label>Deskripsi (Opsional)</label>
            <textarea name="deskripsi" rows="3">{{ old('deskripsi', $pengajian->deskripsi) }}</textarea>

            <div class="actions">
                <a href="{{ route('pengajian.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</body>
</html>