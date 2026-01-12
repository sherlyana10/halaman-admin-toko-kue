<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ isset($pelanggan) ? 'Edit' : 'Tambah' }} Pelanggan</title>

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
            margin-bottom: 20px;
        }

        /* Card Form */
        .form-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 14px 35px rgba(255,93,162,0.2);
        }

        /* Label */
        label {
            font-weight: 500;
            color: #444;
        }

        /* Input */
        .form-control {
            border-radius: 12px;
            border: 1px solid #ffc1da;
            padding: 10px 14px;
        }

        .form-control:focus {
            border-color: #ff5da2;
            box-shadow: 0 0 0 0.2rem rgba(255,93,162,0.25);
        }

        /* Buttons */
        .btn-success {
            background: linear-gradient(135deg, #ff5da2, #ff85b3);
            border: none;
            border-radius: 12px;
            font-weight: 500;
            padding: 8px 20px;
        }

        .btn-secondary {
            border-radius: 12px;
            padding: 8px 20px;
        }

        small.text-danger {
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="container mt-5 d-flex justify-content-center">
    <div class="col-md-6">

        <div class="form-card">
            <h4>
                {{ isset($pelanggan) ? '✏️ Edit' : '➕ Tambah' }} Pelanggan
            </h4>

            <form action="{{ isset($pelanggan) ? route('pelanggan.update', $pelanggan->id) : route('pelanggan.store') }}" method="POST">
                @csrf
                @if(isset($pelanggan)) @method('PUT') @endif

                <div class="mb-3">
                    <label>Nama Pelanggan</label>
                    <input type="text"
                           name="nama_pelanggan"
                           value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan ?? '') }}"
                           class="form-control">
                    @error('nama_pelanggan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>No HP</label>
                    <input type="text"
                           name="no_hp"
                           value="{{ old('no_hp', $pelanggan->no_hp ?? '') }}"
                           class="form-control">
                    @error('no_hp')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3">{{ old('alamat', $pelanggan->alamat ?? '') }}</textarea>
                    @error('alamat')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">
                        ← Kembali
                    </a>

                    <button class="btn btn-success">
                        {{ isset($pelanggan) ? '💾 Update' : '💾 Simpan' }}
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>

</body>
</html>
