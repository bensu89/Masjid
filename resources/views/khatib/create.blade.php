<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Khatib</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #e8f5e9; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 20px auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h1 { color: #2c662d; margin-top: 0; text-align: center; border-bottom: 2px solid #2c662d; padding-bottom: 10px; }
        label { display: block; margin: 15px 0 5px; font-weight: 600; color: #444; }
        input[type="text"], textarea { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; font-size: 14px; }
        .checkbox-group { margin: 20px 0; background: #e8f5e9; padding: 12px; border-radius: 6px; }
        .actions { display: flex; gap: 10px; margin-top: 25px; }
        .btn { padding: 12px 24px; border-radius: 6px; text-decoration: none; border: none; cursor: pointer; font-weight: 600; flex: 1; text-align: center; }
        .btn-primary { background: #2c662d; color: white; }
        .btn-secondary { background: #6c757d; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Khatib Baru</h1>
        <form action="{{ route('khatib.store') }}" method="POST">
            @csrf
            <label>Nama Lengkap & Gelar</label>
            <input type="text" name="nama_khatib" placeholder="Contoh: Ust. H. Ahmad Fauzi, M.Ag." required>

            <label>No. WhatsApp (Awali 08 atau 62)</label>
            <input type="text" name="no_whatsapp" placeholder="Contoh: 08123456789" required>

            <label>Domisili</label>
            <textarea name="domisili" rows="3" placeholder="Contoh: Kec. Sukasari, Kota Bandung"></textarea>

            <div class="checkbox-group">
                <label style="margin-top:0"><input type="checkbox" name="status_aktif" value="1" checked> Khatib Aktif</label>
            </div>

            <div class="actions">
                <a href="{{ route('khatib.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
        </form>
    </div>
</body>
</html>
