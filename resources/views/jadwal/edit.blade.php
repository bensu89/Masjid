<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Jadwal Jumat</title>
</head>
<body>
    <div style="max-width:500px;margin:auto;padding:20px;">
        <h1>Edit Jadwal Jumat</h1>
        <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
            @csrf @method('PUT')
            <label>Tanggal Jumat:</label><br>
            <input type="date" name="tanggal_jumat" value="{{ $jadwal->tanggal_jumat }}" required style="width:100%;padding:8px;"><br><br>

            <label>Pilih Khatib:</label><br>
            <select name="khatib_id" required style="width:100%;padding:8px;">
                @foreach($khatibs as $k)
                    <option value="{{ $k->id }}" {{ $jadwal->khatib_id == $k->id ? 'selected' : '' }}>{{ $k->nama_khatib }}</option>
                @endforeach
            </select><br><br>

            <label>Tema / Judul Khutbah:</label><br>
            <input type="text" name="tema" value="{{ $jadwal->tema }}" style="width:100%;padding:8px;"><br><br>

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
