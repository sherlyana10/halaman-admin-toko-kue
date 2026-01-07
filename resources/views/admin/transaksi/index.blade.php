<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>📄 Data Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>📄 Data Transaksi</h4>

        <form action="{{ route('transaksi.index') }}" method="GET" class="d-flex me-2">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari pelanggan/status..." value="{{ request('search') }}">
            <button class="btn btn-outline-success" type="submit">🔍 Cari</button>
        </form>

        <a href="{{ route('transaksi.create') }}" class="btn btn-primary">➕ Tambah Transaksi</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th>Pelanggan</th>
                        <th>Tanggal</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksis as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->pelanggan->nama_pelanggan ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                            <td>Rp {{ number_format($item->total_harga,0,',','.') }}</td>
                            <td class="text-center">
                                @if($item->status == 'lunas')
                                    <span class="badge bg-success">Lunas</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('transaksi.show', $item->id) }}" class="btn btn-info btn-sm">👁 Lihat</a>

                                <a href="{{ route('transaksi.edit', $item->id) }}" class="btn btn-warning btn-sm">✏️ Edit</a>

                                <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus transaksi?')" class="btn btn-danger btn-sm">🗑 Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Data transaksi kosong</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $transaksis->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
</body>
</html>
