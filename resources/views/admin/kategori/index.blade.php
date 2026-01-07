<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kategori</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>📋 Data Kategori</h4>
        <a href="{{ route('kategori.create') }}" class="btn btn-primary">
            ➕ Tambah Kategori
        </a>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Card --}}
    <div class="card">
        <div class="card-body">

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Kategori</th>
                        <th width="25%">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($kategoris as $item)
                        <tr>
                            {{-- Nomor urut AMAN --}}
                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $item->nama_kategori }}</td>

                            <td>
                                <a href="{{ route('kategori.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    ✏️ Edit
                                </a>

                                <form action="{{ route('kategori.destroy', $item->id) }}" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus kategori?')" 
                                            class="btn btn-danger btn-sm">
                                        🗑 Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                Data kategori masih kosong
                            </td>
                        </tr>
                    @endforelse

                                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif


                </tbody>
            </table>

        </div>
    </div>

</div>

</body>
</html>
