<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pelanggan</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #fff0f6;
        }

        h4 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: #ff5da2;
        }

        /* Card */
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 12px 30px rgba(255,93,162,0.18);
        }

        /* Table */
        .table {
            border-radius: 16px;
            overflow: hidden;
        }

        .table thead {
            background: linear-gradient(135deg, #ff5da2, #ff85b3);
            color: white;
            text-align: center;
        }

        .table tbody tr {
            transition: 0.25s ease;
        }

        .table tbody tr:hover {
            background-color: #ffe6f0;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #ff5da2, #ff85b3);
            border: none;
            border-radius: 12px;
            font-weight: 500;
        }

        .btn-warning {
            background: #ffd6e8;
            border: none;
            color: #ff2f92;
            border-radius: 10px;
        }

        .btn-danger {
            background: #ff2f92;
            border: none;
            border-radius: 10px;
        }

        .btn-outline-success {
            border-color: #ff5da2;
            color: #ff5da2;
            border-radius: 12px;
        }

        .btn-outline-success:hover {
            background: #ff5da2;
            color: white;
        }

        /* Pagination */
        .pagination .page-link {
            color: #ff5da2;
            border-radius: 10px;
        }

        .pagination .active .page-link {
            background: #ff5da2;
            border-color: #ff5da2;
        }

        .alert {
            border-radius: 12px;
        }
    </style>
</head>
<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>👥 Data Pelanggan</h4>

        <form action="{{ route('pelanggan.index') }}" method="GET" class="d-flex me-2">
            <input type="text"
                   name="search"
                   class="form-control me-2"
                   placeholder="Cari pelanggan..."
                   value="{{ request('search') }}">
            <button class="btn btn-outline-success" type="submit">🔍 Cari</button>
        </form>

        <a href="{{ route('pelanggan.create') }}" class="btn btn-primary">
            ➕ Tambah Pelanggan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered table-striped align-middle">
                <thead>
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
                                <a href="{{ route('pelanggan.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    ✏️ Edit
                                </a>

                                <form action="{{ route('pelanggan.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus pelanggan?')" class="btn btn-danger btn-sm">
                                        🗑 Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Data pelanggan kosong
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $pelanggans->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>

</body>
</html>
