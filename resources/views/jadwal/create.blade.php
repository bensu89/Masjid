<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jadwal Jumat</title>
    @include('partials.style')
    <style>.container { max-width: 650px; }</style>
</head>
<body>
    @include('partials.nav')
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

            <div class="form-actions">
                <a href="{{ route('petugas_jumat.index') }}" class="btn btn-danger">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
            </div>
        </form>
    </div>
</body>
</html>