<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h4>✏️ Edit Produk</h4>

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
            <img src="{{ asset('storage/'.$produk->foto) }}" width="120">
        </div>

        <div class="mb-3">
            <label>Ganti Foto (opsional)</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <button class="btn btn-success">💾 Update</button>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

</body>
</html>
