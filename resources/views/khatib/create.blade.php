<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Khatib</title>
</head>
<body>
    <div style="max-width:500px;margin:auto;background:white;padding:20px;">
        <h1>Tambah Khatib</h1>
        <form action="{{ route('khatib.store') }}" method="POST">
            @csrf
            <label>Nama Lengkap & Gelar:</label><br>
            <input type="text" name="nama_khatib" required style="width:100%;padding:8px;"><br><br>

            <label>No. WhatsApp (contoh: 0812345):</label><br>
            <input type="text" name="no_whatsapp" required style="width:100%;padding:8px;"><br><br>

            <label>Domisili:</label><br>
            <textarea name="domisili" style="width:100%;padding:8px;"></textarea><br><br>

            <label><input type="checkbox" name="status_aktif" value="1" checked> Aktif</label><br><br>

            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>
