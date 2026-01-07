<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">➕ Tambah Kategori</h5>
                </div>

                <div class="card-body">
                    {{-- Error --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('kategori.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama Kategori</label>
                            <input type="text"
                                   name="nama_kategori"
                                   class="form-control"
                                   placeholder="Contoh: Kue Basah"
                                   value="{{ old('nama_kategori') }}">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">
                                ← Kembali
                            </a>
                            <button class="btn btn-primary">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
