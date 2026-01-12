<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kategori</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
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
            color: white;
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            border-radius: 20px 20px 0 0;
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

        .btn-success {
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
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-center">
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

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">
                                ⬅️ Kembali
                            </a>
                            <button class="btn btn-success">
                                💾 Update
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
