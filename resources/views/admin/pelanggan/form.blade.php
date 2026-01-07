<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ isset($pelanggan) ? 'Edit' : 'Tambah' }} Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h4>{{ isset($pelanggan) ? '✏️ Edit' : '➕ Tambah' }} Pelanggan</h4>

    <form action="{{ isset($pelanggan) ? route('pelanggan.update', $pelanggan->id) : route('pelanggan.store') }}" method="POST">
        @csrf
        @if(isset($pelanggan)) @method('PUT') @endif

        <div class="mb-3">
            <label>Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan ?? '') }}" class="form-control">
            @error('nama_pelanggan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp', $pelanggan->no_hp ?? '') }}" class="form-control">
            @error('no_hp') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control">{{ old('alamat', $pelanggan->alamat ?? '') }}</textarea>
            @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button class="btn btn-success">{{ isset($pelanggan) ? '💾 Update' : '💾 Simpan' }}</button>
        <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

</body>
</html>
