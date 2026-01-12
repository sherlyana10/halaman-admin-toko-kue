<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>

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

        img {
            border-radius: 16px;
            box-shadow: 0 10px 24px rgba(255,93,162,0.35);
        }

        .btn-success {
            background: linear-gradient(135deg, #ff5da2, #ff8fc7);
            border: none;
            border-radius: 16px;
            padding: 10px 26px;
            font-weight: 600;
        }

        .btn-secondary {
            background: #ffe1ef;
            color: #ff2f92;
            border: none;
            border-radius: 16px;
            padding: 10px 22px;
            font-weight: 500;
        }

        .btn-secondary:hover {
            background: #ffd0e5;
            color: #ff2f92;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card card-form">
                <h4 class="text-center mb-4">✏️ Edit Produk</h4>

                <!-- FORM ASLI (TIDAK DIUBAH) -->
                <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Nama Produk</label>
                        <input type="text" name="nama_produk" value="{{ $produk->nama_produk }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Kategori</label>
                        <select name="kategori_id" class="form-control">
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat->id }}"
                                    {{ $produk->kategori_id == $kat->id ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Harga</label>
                        <input type="number" name="harga" value="{{ $produk->harga }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Foto Saat Ini</label><br>
                        <img src="{{ asset('storage/'.$produk->foto) }}" width="130">
                    </div>

                    <div class="mb-3">
                        <label>Ganti Foto (opsional)</label>
                        <input type="file" name="foto" class="form-control">
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button class="btn btn-success">💾 Update</button>
                        <a href="{{ route('produk.index') }}" class="btn btn-secondary">⬅ Kembali</a>
                    </div>
                </form>
                <!-- END FORM -->

            </div>

        </div>
    </div>
</div>

</body>
</html>
