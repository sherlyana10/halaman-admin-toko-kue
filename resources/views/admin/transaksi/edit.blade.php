<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>✏️ Edit Transaksi</title>

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

        /* Card */
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 14px 35px rgba(255,93,162,0.2);
        }

        /* Form */
        label {
            font-weight: 500;
            color: #7a0041;
        }

        .form-control, .form-select {
            border-radius: 12px;
        }

        /* Table */
        .table {
            border-radius: 16px;
            overflow: hidden;
        }

        .table thead {
            background: linear-gradient(135deg, #ff5da2, #ff85b3);
            color: white;
            text-align: center;
        }

        .table td, .table th {
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #ffe6f0;
        }

        /* Buttons */
        .btn-success {
            background: linear-gradient(135deg, #ff5da2, #ff85b3);
            border: none;
            border-radius: 12px;
        }

        .btn-secondary {
            border-radius: 12px;
        }

        .btn-danger {
            background: #ff2f92;
            border: none;
            border-radius: 10px;
        }

        .btn-success.btn-sm {
            background: #ffd6e8;
            color: #ff2f92;
            border: none;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <div class="card">
        <div class="card-body">

            <h4>✏️ Edit Transaksi</h4>

            <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Pilih Pelanggan --}}
                <div class="mb-3">
                    <label>Pelanggan</label>
                    <select name="pelanggan_id" class="form-control">
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach($pelanggans as $pelanggan)
                            <option value="{{ $pelanggan->id }}" 
                                {{ $transaksi->pelanggan_id == $pelanggan->id ? 'selected' : '' }}>
                                {{ $pelanggan->nama_pelanggan }}
                            </option>
                        @endforeach
                    </select>
                    @error('pelanggan_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Tanggal --}}
                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $transaksi->tanggal) }}" class="form-control">
                    @error('tanggal') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="pending" {{ $transaksi->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="lunas" {{ $transaksi->status == 'lunas' ? 'selected' : '' }}>Lunas</option>
                    </select>
                    @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Produk + Jumlah --}}
                <div class="mb-3">
                    <label>Produk</label>
                    <table class="table table-bordered" id="produkTable">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th width="10%">
                                    <button type="button" class="btn btn-sm btn-success" id="addRow">➕</button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi->produk as $item)
                            <tr>
                                <td>
                                    <select name="produk[]" class="form-control">
                                        <option value="">-- Pilih Produk --</option>
                                        @foreach($produks as $produk)
                                            <option value="{{ $produk->id }}"
                                                {{ $item->id == $produk->id ? 'selected' : '' }}>
                                                {{ $produk->nama_produk }} (Rp {{ number_format($produk->harga,0,',','.') }})
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="jumlah[]" class="form-control" value="{{ $item->pivot->jumlah }}" min="1">
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-danger removeRow">❌</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <button class="btn btn-success">💾 Update Transaksi</button>
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
            </form>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('#addRow').click(function(){
        var newRow = `<tr>
            <td>
                <select name="produk[]" class="form-control">
                    <option value="">-- Pilih Produk --</option>
                    @foreach($produks as $produk)
                        <option value="{{ $produk->id }}">{{ $produk->nama_produk }} (Rp {{ number_format($produk->harga,0,',','.') }})</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="number" name="jumlah[]" class="form-control" value="1" min="1">
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-danger removeRow">❌</button>
            </td>
        </tr>`;
        $('#produkTable tbody').append(newRow);
    });

    $(document).on('click', '.removeRow', function(){
        $(this).closest('tr').remove();
    });
});
</script>

</body>
</html>
