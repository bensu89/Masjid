<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Transaksi - Admin</title>
    @include('partials.style')
    <style>
        .actions { margin: 15px 0; }
    </style>
</head>
<body>
    @include('partials.nav')
    <div class="container">
        <h1>Kelola Transaksi - Masjid Nurul Qolbi</h1>
        
        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <div class="actions">
            <a href="{{ route('transactions.create') }}" class="btn btn-primary">+ Tambah Transaksi</a>
        </div>

        

        @if($transactions->isEmpty())
            <div class="alert">Tidak ada data transaksi.</div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Deskripsi</th>
                        <th>Pemasukan</th>
                        <th>Pengeluaran</th>
                        <th>Saldo</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $i => $t)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d/m/Y') }}</td>
                        <td>{{ $t->deskripsi }}</td>
                        <td>Rp {{ number_format($t->pemasukan, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($t->pengeluaran, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($t->saldo, 0, ',', '.') }}</td>
                        <td>
                            <div class="action-btns">
                                <a href="{{ route('transactions.edit', $t->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('transactions.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
