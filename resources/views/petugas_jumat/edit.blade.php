<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Petugas Jumat</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #f4f6f9; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 20px auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h1 { color: #2c662d; margin-top: 0; text-align: center; border-bottom: 2px solid #2c662d; padding-bottom: 10px; }
        label { display: block; margin: 15px 0 5px; font-weight: 600; color: #444; }
        input, select, textarea { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; font-size: 14px; }
        .checkbox-group { margin: 20px 0; background: #e8f5e9; padding: 12px; border-radius: 6px; }
        .actions { display: flex; gap: 10px; margin-top: 25px; }
        .btn { padding: 12px 24px; border-radius: 6px; text-decoration: none; border: none; cursor: pointer; font-weight: 600; flex: 1; text-align: center; }
        .btn-primary { background: #2c662d; color: white; }
        .btn-secondary { background: #6c757d; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Petugas Jumat</h1>
        <form action="{{ route('petugas_jumat.update', $petugas->id) }}" method="POST">
            @csrf @method('PUT')
            <label>Nama Lengkap & Gelar</label>
            <input type="text" name="nama_petugas" value="{{ $petugas->nama_petugas }}" required>

            <label>Peran Utama (Opsional)</label>
            <select name="peran_utama">
                <option value="">-- Belum Ditentukan --</option>
                <option value="Khatib" {{ $petugas->peran_utama=='Khatib'?'selected':'' }}>Khatib</option>
                <option value="Imam" {{ $petugas->peran_utama=='Imam'?'selected':'' }}>Imam</option>
                <option value="Bilal" {{ $petugas->peran_utama=='Bilal'?'selected':'' }}>Bilal / Muadzin</option>
            </select>
            <small style="color:#666;font-size:12px;">Bisa ditentukan nanti saat membuat jadwal.</small>

            <label>No. WhatsApp</label>
            <input type="text" name="no_whatsapp" value="{{ $petugas->no_whatsapp }}" required>

            <label>Domisili</label>
            <textarea name="domisili" rows="3">{{ $petugas->domisili }}</textarea>

            <div class="checkbox-group">
                <label style="margin-top:0"><input type="checkbox" name="status_aktif" value="1" {{ $petugas->status_aktif ? 'checked' : '' }}> Petugas Aktif</label>
            </div>

            <div class="actions">
                <a href="{{ route('petugas_jumat.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update Data</button>
            </div>
        </form>
    </div>
</body>
</html>