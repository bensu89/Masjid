<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal Jumat</title>
    @include('partials.style')
    <style>.container { max-width: 650px; }</style>
</head>
<body>
    @include('partials.nav')
    <div class="container">
        <h1>Edit Jadwal Jumat</h1>
        <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
            @csrf @method('PUT')
            <label>Tanggal Jumat</label>
            <input type="date" name="tanggal_jumat" value="{{ $jadwal->tanggal_jumat }}" required>

            <label>Khatib</label>
            <select name="khatib_id" required>
                @foreach($petugas as $p)
                    <option value="{{ $p->id }}" {{ $jadwal->khatib_id == $p->id ? 'selected' : '' }}>{{ $p->nama_petugas }}{{ $p->peran_utama ? ' (' . $p->peran_utama . ')' : '' }}</option>
                @endforeach
            </select>

            <label>Imam</label>
            <select name="imam_id">
                <option value="">-- Pilih Imam --</option>
                @foreach($petugas as $p)
                    <option value="{{ $p->id }}" {{ $jadwal->imam_id == $p->id ? 'selected' : '' }}>{{ $p->nama_petugas }}{{ $p->peran_utama ? ' (' . $p->peran_utama . ')' : '' }}</option>
                @endforeach
            </select>

            <label>Bilal / Muadzin</label>
            <select name="bilal_id">
                <option value="">-- Pilih Bilal --</option>
                @foreach($petugas as $p)
                    <option value="{{ $p->id }}" {{ $jadwal->bilal_id == $p->id ? 'selected' : '' }}>{{ $p->nama_petugas }}{{ $p->peran_utama ? ' (' . $p->peran_utama . ')' : '' }}</option>
                @endforeach
            </select>

            <label>Tema / Judul Khutbah</label>
            <input type="text" name="tema" value="{{ $jadwal->tema }}">

            <div class="form-actions">
                <a href="{{ route('petugas_jumat.index') }}" class="btn btn-danger">Batal</a>
                <button type="submit" class="btn btn-primary">Update Jadwal</button>
            </div>
        </form>
    </div>
</body>
</html>