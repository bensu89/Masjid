<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Jadwal Jumat</title>
</head>
<body>
    <div style="max-width:500px;margin:auto;padding:20px;">
        <h1>Tambah Jadwal Jumat</h1>
        <form action="{{ route('jadwal.store') }}" method="POST">
            @csrf
            <label>Tanggal Jumat:</label><br>
            <input type="date" name="tanggal_jumat" required style="width:100%;padding:8px;"><br><br>

            <label>Pilih Khatib (Hanya yang Aktif):</label><br>
            <select name="khatib_id" required style="width:100%;padding:8px;">
                <option value="">-- Pilih Ustadz --</option>
                @foreach($khatibs as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_khatib }} ({{ $k->domisili }})</option>
                @endforeach
            </select><br><br>

            <label>Tema / Judul Khutbah:</label><br>
            <input type="text" name="tema" style="width:100%;padding:8px;"><br><br>

            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>
