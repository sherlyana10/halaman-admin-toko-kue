<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-warning text-dark">
            ✏️ Edit Kategori
        </div>

        <div class="card-body">
            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text"
                           name="nama_kategori"
                           class="form-control"
                           value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                           required>
                </div>

                <button class="btn btn-success">💾 Update</button>
                <a href="{{ route('kategori.index') }}" class="btn btn-secondary">⬅️ Kembali</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
