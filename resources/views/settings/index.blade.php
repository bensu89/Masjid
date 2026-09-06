<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengaturan Fitur</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #e8f5e9; margin: 0; padding: 20px; }
        .container { max-width: 700px; margin: 20px auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h1 { color: #2c662d; margin-top: 0; text-align: center; border-bottom: 2px solid #2c662d; padding-bottom: 10px; }
        label { display: block; margin: 15px 0 5px; font-weight: 600; color: #444; }
        input { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; font-size: 14px; }
        .actions { display: flex; gap: 10px; margin-top: 25px; }
        .btn { padding: 12px 24px; border-radius: 6px; text-decoration: none; border: none; cursor: pointer; font-weight: 600; flex: 1; text-align: center; }
        .btn-primary { background: #2c662d; color: white; }
        .btn-secondary { background: #6c757d; color: white; }
        .alert { background: #d4edda; color: #155724; padding: 12px; border-radius: 6px; margin-bottom: 15px; }
    </style>
</head>
<body>
    @include('partials.nav')
    <div class="container">
        <h1>Pengaturan Fitur Publik</h1>
        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif
        <form action="{{ route('settings.update') }}" method="POST">
            @csrf
            @method('PUT')
            <label style="display:flex; align-items:center; gap:10px; cursor:pointer;">
                <input type="checkbox" name="jadwal_shalat_jumat_enabled" {{ $settings->jadwal_shalat_jumat_enabled ? 'checked' : '' }}>
                Jadwal Sholat Jumat
            </label>
            <label style="display:flex; align-items:center; gap:10px; cursor:pointer;">
                <input type="checkbox" name="jadwal_pengajian_enabled" {{ $settings->jadwal_pengajian_enabled ? 'checked' : '' }}>
                Jadwal Pengajian
            </label>
            <label style="display:flex; align-items:center; gap:10px; cursor:pointer;">
                <input type="checkbox" name="laporan_keuangan_enabled" {{ $settings->laporan_keuangan_enabled ? 'checked' : '' }}>
                Laporan Keuangan
            </label>
            <div class="actions">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('transactions.admin') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>