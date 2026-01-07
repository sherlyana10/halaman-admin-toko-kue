<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>👥 Data Pelanggan</h4>

        <form action="{{ route('pelanggan.index') }}" method="GET" class="d-flex me-2">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari pelanggan..." value="{{ request('search') }}">
            <button class="btn btn-outline-success" type="submit">🔍 Cari</button>
        </form>

        <a href="{{ route('pelanggan.create') }}" class="btn btn-primary">➕ Tambah Pelanggan</a>
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
                        <th>Nama Pelanggan</th>
                        <th>No HP</th>
                        <th>Alamat</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pelanggans as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_pelanggan }}</td>
                            <td>{{ $item->no_hp }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td class="text-center">
                                <a href="{{ route('pelanggan.edit', $item->id) }}" class="btn btn-warning btn-sm">✏️ Edit</a>

                                <form action="{{ route('pelanggan.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus pelanggan?')" class="btn btn-danger btn-sm">🗑 Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Data pelanggan kosong</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $pelanggans->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

</div>
</body>
</html>
