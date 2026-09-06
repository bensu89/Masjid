<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Fitur - Admin</title>
    @include('partials.style')
    <style>
        .container { max-width: 900px; }
        .subtitle { text-align: center; color: #666; margin-top: -10px; margin-bottom: 20px; }
        .settings-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 12px; }
        .setting-card {
            border: 1px solid #dce3dd;
            border-radius: 10px;
            padding: 14px;
            background: #f8fbf8;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }
        .setting-card input { width: auto; margin: 0; }
        .setting-title { font-weight: 600; color: #2c662d; }
        .setting-desc { font-size: 12px; color: #666; margin-top: 2px; }
        .actions-wrap { display: flex; gap: 10px; justify-content: center; margin-top: 20px; }
        @media (max-width: 900px) { .settings-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    @include('partials.nav')
    <div class="container">
        <h1>Pengaturan Fitur Publik</h1>
        <p class="subtitle">Aktifkan atau nonaktifkan modul yang tampil di Dashboard Warga.</p>

        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <form action="{{ route('settings.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="settings-grid">
                <label class="setting-card">
                    <input type="checkbox" name="jadwal_shalat_jumat_enabled" {{ $settings->jadwal_shalat_jumat_enabled ? 'checked' : '' }}>
                    <div>
                        <div class="setting-title">Jadwal Sholat Jumat</div>
                        <div class="setting-desc">Tampilkan jadwal khutbah dan petugas Jumat.</div>
                    </div>
                </label>

                <label class="setting-card">
                    <input type="checkbox" name="jadwal_pengajian_enabled" {{ $settings->jadwal_pengajian_enabled ? 'checked' : '' }}>
                    <div>
                        <div class="setting-title">Jadwal Pengajian</div>
                        <div class="setting-desc">Tampilkan daftar agenda pengajian terbaru.</div>
                    </div>
                </label>

                <label class="setting-card">
                    <input type="checkbox" name="laporan_keuangan_enabled" {{ $settings->laporan_keuangan_enabled ? 'checked' : '' }}>
                    <div>
                        <div class="setting-title">Laporan Keuangan</div>
                        <div class="setting-desc">Tampilkan ringkasan dan rincian transaksi.</div>
                    </div>
                </label>
            </div>

            <div class="actions-wrap">
                <button type="submit" class="btn btn-success">Simpan Pengaturan</button>
                <a href="{{ route('transactions.admin') }}" class="btn btn-danger">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>