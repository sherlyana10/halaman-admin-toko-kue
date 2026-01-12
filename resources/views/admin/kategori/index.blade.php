<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kategori</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #fff0f6;
        }

        h4 {
            color: #ff5da2;
            font-weight: 600;
        }

        /* Card jadi soft pink */
        .card {
            border-radius: 18px;
            border: none;
            box-shadow: 0 12px 30px rgba(255,93,162,.2);
        }

        /* 🔥 OVERRIDE table-dark jadi PINK */
        .table-dark {
            --bs-table-bg: #ff5da2;
            --bs-table-striped-bg: #ff85b3;
            --bs-table-striped-color: #fff;
            --bs-table-color: #fff;
            --bs-table-border-color: #ff85b3;
        }

        /* Table hover */
        .table tbody tr:hover {
            background-color: #ffe3ef !important;
        }

        /* Button primary jadi pink */
        .btn-primary {
            background-color: #ff5da2;
            border: none;
        }

        .btn-primary:hover {
            background-color: #ff3c91;
        }

        /* Button warning soft pink */
        .btn-warning {
            background-color: #ffd6e8;
            border: none;
            color: #ff2f92;
        }

        /* Button danger pink gelap */
        .btn-danger {
            background-color: #ff2f92;
            border: none;
        }

        .alert {
            border-radius: 12px;
        }
    </style>
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
