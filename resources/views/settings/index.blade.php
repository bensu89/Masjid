<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Fitur - Admin</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #e8f5e9; }
        .nav { background: #2c662d; padding: 12px 20px; display: flex; gap: 15px; flex-wrap: wrap; }
        .nav a { color: white; text-decoration: none; padding: 8px 16px; border-radius: 4px; }
        .nav a.active { background: rgba(255,255,255,0.25); font-weight: bold; }
        .nav a.logout { margin-left: auto; background: rgba(220,53,69,0.6); }
        .container { max-width: 1100px; margin: 20px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h1 { color: #2c662d; text-align: center; }
        .alert { background: #d4edda; color: #155724; padding: 12px; border-radius: 4px; margin-bottom: 15px; }
        .btn { padding: 8px 15px; text-decoration: none; border-radius: 4px; color: white; display: inline-block; border: none; cursor: pointer; }
        .btn-primary { background: #007bff; }
        .btn-success { background: #28a745; }
        .btn-warning { background: #ffc107; color: #333; }
        .btn-danger { background: #dc3545; }
        @media (max-width: 768px) {
            .container { padding: 15px; }
            h1 { font-size: 20px; }
            .nav { flex-wrap: wrap; }
        }
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
            <div style="display:flex; flex-wrap:wrap; gap:15px; align-items:center;">
                <label style="display:flex; align-items:center; gap:5px; cursor:pointer;">
                    <input type="checkbox" name="jadwal_shalat_jumat_enabled" {{ $settings->jadwal_shalat_jumat_enabled ? 'checked' : '' }}>
                    Jadwal Sholat Jumat
                </label>
                <label style="display:flex; align-items:center; gap:5px; cursor:pointer;">
                    <input type="checkbox" name="jadwal_pengajian_enabled" {{ $settings->jadwal_pengajian_enabled ? 'checked' : '' }}>
                    Jadwal Pengajian
                </label>
                <label style="display:flex; align-items:center; gap:5px; cursor:pointer;">
                    <input type="checkbox" name="laporan_keuangan_enabled" {{ $settings->laporan_keuangan_enabled ? 'checked' : '' }}>
                    Laporan Keuangan
                </label>
                <button type="submit" class="btn btn-success">Simpan Pengaturan</button>
                <a href="{{ route('transactions.admin') }}" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>