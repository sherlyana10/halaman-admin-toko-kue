<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>🍰 Data Produk</h4>

         <form action="{{ route('produk.index') }}" method="GET" class="d-flex" role="search">
        <input type="text" name="search" class="form-control me-2" placeholder="Cari produk..." value="{{ request('search') }}">
        <button class="btn btn-outline-success" type="submit">🔍 Cari</button>
    </form>

        <a href="{{ route('produk.create') }}" class="btn btn-primary">
            ➕ Tambah Produk
        </a>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Foto</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produks as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>

                            <td class="text-center">
                                @if($item->foto)
                                    <img src="{{ asset('storage/'.$item->foto) }}" width="80" class="rounded">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>

                            <td>{{ $item->nama_produk }}</td>
                            <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>

                            <td class="text-center">
                                <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    ✏️ Edit
                                </a>

                                <form action="{{ route('produk.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus produk?')" class="btn btn-danger btn-sm">
                                        🗑 Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Data produk kosong
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3"> {{ $produks->links('pagination::bootstrap-5') }} </div>

        </div>
    </div>

</div>

</body>
</html>
