<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #fff0f6;
        }

        .card-form {
            border: none;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(255, 105, 180, 0.25);
            padding: 30px;
        }

        h4 {
            font-family: 'Playfair Display', serif;
            color: #ff4f9a;
            font-weight: 700;
        }

        label {
            font-weight: 500;
            color: #ff2f92;
            margin-bottom: 6px;
        }

        .form-control {
            border-radius: 14px;
            border: 1px solid #ffc1dc;
            padding: 10px 14px;
        }

        .form-control:focus {
            border-color: #ff5da2;
            box-shadow: 0 0 0 0.2rem rgba(255,93,162,.25);
        }

        textarea {
            resize: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #ff5da2, #ff8fc7);
            border: none;
            border-radius: 16px;
            padding: 10px 28px;
            font-weight: 600;
        }

        .btn-primary:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card card-form">
                <h4 class="text-center mb-4">➕ Tambah Produk</h4>

                <!-- FORM ASLI (TIDAK DIUBAH) -->
                <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label>Kategori</label>
                <select name="kategori_id" class="form-control mb-2">
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                    @endforeach
                </select>

                <label>Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control mb-2">

                <label>Harga</label>
                <input type="number" name="harga" class="form-control mb-2">

                <label>Stok</label>
                <input type="number" name="stok" class="form-control mb-2">

                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control mb-2" rows="4"></textarea>

                <label>Foto</label>
                <input type="file" name="foto" class="form-control mb-3">

                <div class="text-end">
                    <button class="btn btn-primary">💾 Simpan</button>
                </div>
                </form>
                <!-- END FORM -->

            </div>

        </div>
    </div>
</div>

</body>
</html>
