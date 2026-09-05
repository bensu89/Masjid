<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Khatib</title>
</head>
<body>
    <div style="max-width:500px;margin:auto;background:white;padding:20px;">
        <h1>Edit Khatib</h1>
        <form action="{{ route('khatib.update', $khatib->id) }}" method="POST">
            @csrf @method('PUT')
            <label>Nama Lengkap & Gelar:</label><br>
            <input type="text" name="nama_khatib" value="{{ $khatib->nama_khatib }}" required style="width:100%;padding:8px;"><br><br>

            <label>No. WhatsApp:</label><br>
            <input type="text" name="no_whatsapp" value="{{ $khatib->no_whatsapp }}" required style="width:100%;padding:8px;"><br><br>

            <label>Domisili:</label><br>
            <textarea name="domisili" style="width:100%;padding:8px;">{{ $khatib->domisili }}</textarea><br><br>

            <label><input type="checkbox" name="status_aktif" value="1" {{ $khatib->status_aktif ? 'checked' : '' }}> Aktif</label><br><br>

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
