<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Jadwal Jumat</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #f4f6f9; margin: 0; padding: 20px; }
        .container { max-width: 650px; margin: 20px auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h1 { color: #2c662d; margin-top: 0; text-align: center; border-bottom: 2px solid #2c662d; padding-bottom: 10px; }
        label { display: block; margin: 15px 0 5px; font-weight: 600; color: #444; }
        input, select { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; font-size: 14px; }
        .actions { display: flex; gap: 10px; margin-top: 25px; }
        .btn { padding: 12px 24px; border-radius: 6px; text-decoration: none; border: none; cursor: pointer; font-weight: 600; flex: 1; text-align: center; }
        .btn-primary { background: #2c662d; color: white; }
        .btn-secondary { background: #6c757d; color: white; }
        .hint { font-size: 12px; color: #888; margin-top: 3px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Jadwal Jumat</h1>
        <form action="{{ route('jadwal.store') }}" method="POST">
            @csrf
            <label>Tanggal Jumat</label>
            <input type="date" name="tanggal_jumat" required>

            <label>Khatib (Pilih dari daftar petugas)</label>
            <select name="khatib_id" required>
                <option value="">-- Pilih Khatib --</option>
                @foreach($petugas as $p)
                    <option value="{{ $p->id }}">{{ $p->nama_petugas }}{{ $p->peran_utama ? ' (' . $p->peran_utama . ')' : '' }}</option>
                @endforeach
            </select>

            <label>Imam (Opsional - bisa dirangkap Khatib)</label>
            <select name="imam_id">
                <option value="">-- Pilih Imam --</option>
                @foreach($petugas as $p)
                    <option value="{{ $p->id }}">{{ $p->nama_petugas }}{{ $p->peran_utama ? ' (' . $p->peran_utama . ')' : '' }}</option>
                @endforeach
            </select>

            <label>Bilal / Muadzin (Opsional)</label>
            <select name="bilal_id">
                <option value="">-- Pilih Bilal --</option>
                @foreach($petugas as $p)
                    <option value="{{ $p->id }}">{{ $p->nama_petugas }}{{ $p->peran_utama ? ' (' . $p->peran_utama . ')' : '' }}</option>
                @endforeach
            </select>

            <label>Tema / Judul Khutbah (Opsional)</label>
            <input type="text" name="tema" placeholder="Contoh: Menggapai Berkah di Hari Jumat">

            <div class="actions">
                <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
            </div>
        </form>
    </div>
</body>
</html>