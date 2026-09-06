<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jadwal Pengajian</title>
    @include('partials.style')
    <style>.container { max-width: 650px; }</style>
</head>
<body>
    @include('partials.nav')
    <div class="container">
        <h1>Tambah Jadwal Pengajian</h1>
        <form method="POST" action="{{ route('pengajian.store') }}">
            @csrf
            <label>Judul Pengajian</label>
            <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Kajian Tauhid" required>

            <label>Pemateri / Ustadz</label>
            <input type="text" name="pemateri" value="{{ old('pemateri') }}" placeholder="Contoh: Ustadz Abdullah" required>

            <label>Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal') }}" required>

            <label>Waktu</label>
            <input type="text" name="waktu" value="{{ old('waktu') }}" placeholder="Contoh: Ba'da Maghrib">

            <label>Lokasi</label>
            <input type="text" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Masjid Utama">

            <label>Deskripsi (Opsional)</label>
            <textarea name="deskripsi" rows="3" placeholder="Deskripsi singkat">{{ old('deskripsi') }}</textarea>

            <div class="form-actions">
                <a href="{{ route('pengajian.index') }}" class="btn btn-danger">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>