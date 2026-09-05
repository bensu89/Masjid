<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Acara Keagamaan</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #f4f6f9; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 20px auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
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
        <h1>Edit Acara Keagamaan</h1>
        <form action="{{ route('acara.update', $acara->id) }}" method="POST">
            @csrf @method('PUT')
            <label>Judul Acara</label>
            <input type="text" name="judul" value="{{ $acara->judul }}" required>

            <label>Tanggal Acara</label>
            <input type="date" name="tanggal_acara" value="{{ $acara->tanggal_acara }}" required>

            <label>Waktu</label>
            <input type="text" name="waktu" value="{{ $acara->waktu }}">

            <label>Lokasi</label>
            <input type="text" name="lokasi" value="{{ $acara->lokasi }}">

            <label>Deskripsi</label>
            <textarea name="deskripsi" rows="4">{{ $acara->deskripsi }}</textarea>

            <div class="actions">
                <a href="{{ route('acara.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update Acara</button>
            </div>
        </form>
    </div>
</body>
</html>