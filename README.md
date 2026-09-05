membangun aplikasi pencatatan keuangan masjid dengan fitur:

- dashboard warga (lihat transaksi dan jadwal shalat)
- admin akses
  - transaksi (tambah/edit/hapus) dan hitung saldo otomatis
  - data khatib (ditambah/diedit)
  - jadwal jumat (ditambah/edit) dan juga menampilkan petugas (khatib, imam, bilal) dan acara keagamaan

### fitur utama

- sistem ini dibangun menggunakan php (framework laravel 12) dan mySQL (xampp).
- aplikasi ini berjalan pada local host port 8000 dan dapat diakses melalui web browser
- ada fitur login admin untuk mengakses semua fitur admin yang ada pada aplikasi ini
- fitur-fitur yang ada pada aplikasi ini terintegrasi satu sama lain

## instalasi

```bash
ds composer install
php artisan serve
```

## cara menggunakan

- buka web browser
- ketik alamat: http://localhost:8000
- ada halaman dashboard yang menampilkan saldo akhir, informasi jadwal shalat jumat dan daftar transaksi
- silahkan input data transaksi pada halaman dashboard admin
- menu admin:
  - data khatib
  - jadwal jumat
  - acara keagamaan
  - transaksi (admin)

## katalog API

- GET /api/shalat (Ambil jadwal shalat dari equran.id)

## bagian frontend

### dashboard warga
- menampilkan saldo akhir, informasi jadwal shalat hari ini dan daftar transaksi
- menampilkan informasi tentang petugas jumat hari ini

### dashboard admin
- tambah transaksi (form transaksi)
- tampilkan daftar transaksi (edit/hapus)
- data khatib (create/read/update/delete)
- jadwal jumat (create/read/update/delete)
- acara keagamaan (create/read/update/delete)

### fitur lain

- routing menggunakan file routes/web.php, dan tiap controller dibuat resource controller untuk mengimplementasikan fitur CRUD (create, read, update, delete)
- menggunakan bootstrap/app.php untuk menambahkan middleware autentikasi dan penjadwalan tugas (jadwal shalat)
- digunakan database migrations yang terstruktur dan relasi antar tabel
- menggunakan syntax blade pada file view untuk membuat tampilan HTML

## struktur direktori

```
.
├── app/
│   ├── Http/
│   │   ├── Controllers/ (TransactionController, KhatibController, JadwalController, AcaraController, dll)
│   │   └── Middleware/ (AdminMiddleware)
│   ├── Models/ (Transaction, Khatib, Jadwal, Acara)
│   └── Console/ (Commands, etc)
├── database/
│   ├── migrations/ (database structure)
│   └── seeds/ (data dummy)
├── resources/
│   ├── views/ (view files, with layouts and partials)
│   │   ├── partials/ (sidebar navigation)
│   │   └── transactions/
│   │       ├── create.blade.php
│   │       └── ...
│   └── ...
├── composer.json
└── package.json
```

## fitur yang akan datang

- [ ] simpan jadwal shalat offline
- [ ] notifikasi untuk acara keagamaan baru
- [ ] integrasi dengan google calender
- [ ] notifcation system

## lisensi

MIT

## author

- @nunanky (github)

