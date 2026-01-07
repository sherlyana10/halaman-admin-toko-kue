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
<textarea name="deskripsi" class="form-control mb-2"></textarea>

<label>Foto</label>
<input type="file" name="foto" class="form-control mb-3">

<button class="btn btn-primary">Simpan</button>
</form>
