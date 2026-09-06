<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Petugas Jumat</title>
    @include('partials.style')
    <style>
        .container { max-width: 600px; }
        .checkbox-group { margin: 20px 0; background: #e8f5e9; padding: 12px; border-radius: 6px; }
        .checkbox-group label { margin: 0; display:flex; align-items:center; gap:8px; }
        .checkbox-group input { width: auto; }
    </style>
</head>
<body>
    @include('partials.nav')
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
                <label><input type="checkbox" name="status_aktif" value="1" {{ $petugas->status_aktif ? 'checked' : '' }}> Petugas Aktif</label>
            </div>

            <div class="form-actions">
                <a href="{{ route('petugas_jumat.index') }}" class="btn btn-danger">Batal</a>
                <button type="submit" class="btn btn-primary">Update Data</button>
            </div>
        </form>
    </div>
</body>
</html>