<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #fff0f6;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 14px 35px rgba(255,93,162,0.18);
        }

        .card-header {
            background: linear-gradient(135deg, #ff5da2, #ff85b3);
            border-radius: 20px 20px 0 0;
            color: white;
            font-family: 'Playfair Display', serif;
        }

        .form-label {
            font-weight: 500;
            color: #ff2f92;
        }

        .form-control {
            border-radius: 12px;
        }

        .form-control:focus {
            border-color: #ff5da2;
            box-shadow: 0 0 0 0.2rem rgba(255,93,162,0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #ff5da2, #ff85b3);
            border: none;
            border-radius: 12px;
            font-weight: 500;
        }

        .btn-secondary {
            background: #ffd6e8;
            border: none;
            color: #ff2f92;
            border-radius: 12px;
            font-weight: 500;
        }

        .btn-secondary:hover {
            background: #ffb3d9;
            color: #ff2f92;
        }

        .alert {
            border-radius: 12px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-center">
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
                                💾 Simpan
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
