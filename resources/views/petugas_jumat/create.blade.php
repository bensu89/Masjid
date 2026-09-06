<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Petugas Jumat</title>
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
        <h1>Tambah Petugas Jumat</h1>
        <form action="{{ route('petugas_jumat.store') }}" method="POST">
            @csrf
            <label>Nama Lengkap & Gelar</label>
            <input type="text" name="nama_petugas" placeholder="Contoh: Ust. H. Ahmad Fauzi, M.Ag." required>

            <label>Peran Utama (Opsional)</label>
            <select name="peran_utama">
                <option value="">-- Belum Ditentukan --</option>
                <option value="Khatib">Khatib</option>
                <option value="Imam">Imam</option>
                <option value="Bilal">Bilal / Muadzin</option>
            </select>
            <small style="color:#666;font-size:12px;">Bisa ditentukan nanti saat membuat jadwal.</small>

            <label>No. WhatsApp (Awali 08 atau 62)</label>
            <input type="text" name="no_whatsapp" placeholder="Contoh: 08123456789" required>

            <label>Domisili</label>
            <textarea name="domisili" rows="3" placeholder="Contoh: Kec. Sukasari, Kota Bandung"></textarea>

            <div class="checkbox-group">
                <label><input type="checkbox" name="status_aktif" value="1" checked> Petugas Aktif</label>
            </div>

            <div class="form-actions">
                <a href="{{ route('petugas_jumat.index') }}" class="btn btn-danger">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </form>
    </div>
</body>
</html>