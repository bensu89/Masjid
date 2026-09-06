<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal Pengajian</title>
    @include('partials.style')
    <style>.container { max-width: 650px; }</style>
</head>
<body>
    @include('partials.nav')
    <div class="container">
        <h1>Edit Jadwal Pengajian</h1>
        <form method="POST" action="{{ route('pengajian.update', $pengajian->id) }}">
            @csrf
            @method('PUT')
            <label>Judul Pengajian</label>
            <input type="text" name="judul" value="{{ old('judul', $pengajian->judul) }}" required>

            <label>Pemateri / Ustadz</label>
            <input type="text" name="pemateri" value="{{ old('pemateri', $pengajian->pemateri) }}" required>

            <label>Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal', $pengajian->tanggal) }}" required>

            <label>Waktu</label>
            <input type="text" name="waktu" value="{{ old('waktu', $pengajian->waktu) }}">

            <label>Lokasi</label>
            <input type="text" name="lokasi" value="{{ old('lokasi', $pengajian->lokasi) }}">

            <label>Deskripsi (Opsional)</label>
            <textarea name="deskripsi" rows="3">{{ old('deskripsi', $pengajian->deskripsi) }}</textarea>

            <div class="form-actions">
                <a href="{{ route('pengajian.index') }}" class="btn btn-danger">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</body>
</html>