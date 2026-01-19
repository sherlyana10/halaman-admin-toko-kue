@extends('layouts.dashboard')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>➕ Tambah Transaksi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        h4 { font-weight: 700; color: #ff5da2; }
        .table thead { background: #ff5da2; color: #fff; }
        .btn-success { background: #ff5da2; border: none; }
    </style>
</head>
<body>

<div class="container mt-4">
    <div class="card">
        <div class="card-body">

            <h4>➕ Tambah Transaksi</h4>

            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf

                {{-- Pelanggan --}}
                <div class="mb-3">
                    <label>Pelanggan</label>
                    <select name="pelanggan_id" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        @foreach($pelanggans as $pelanggan)
                            <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama_pelanggan }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Tanggal --}}
                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}">
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="pending">Pending</option>
                        <option value="lunas">Lunas</option>
                    </select>
                </div>

                {{-- Produk --}}
                <table class="table table-bordered" id="produkTable">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th width="10%">Qty</th>
                            <th width="20%">Subtotal</th>
                            <th width="5%">
                                <button type="button" class="btn btn-sm btn-light" id="addRow">➕</button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select name="produk[]" class="form-control produk">
                                    <option value="">-- Pilih Produk --</option>
                                    @foreach($produks as $produk)
                                        <option value="{{ $produk->id }}" data-harga="{{ $produk->harga }}">
                                            {{ $produk->nama_produk }} (Rp {{ number_format($produk->harga,0,',','.') }})
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="jumlah[]" class="form-control qty" value="1" min="1">
                            </td>
                            <td class="subtotal text-end">Rp 0</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm removeRow">❌</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                {{-- TOTAL --}}
                <div class="text-end mb-3">
                    <h5><b>Total: <span id="totalHarga">Rp 0</span></b></h5>
                </div>

                <button class="btn btn-success">💾 Simpan</button>
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>

            </form>

        </div>
    </div>
</div>

{{-- JS --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function hitungTotal() {
    let total = 0;
    $('#produkTable tbody tr').each(function () {
        let harga = $(this).find('.produk option:selected').data('harga') || 0;
        let qty = $(this).find('.qty').val() || 0;
        let subtotal = harga * qty;
        $(this).find('.subtotal').text('Rp ' + subtotal.toLocaleString('id-ID'));
        total += subtotal;
    });
    $('#totalHarga').text('Rp ' + total.toLocaleString('id-ID'));
}

$(document).on('change keyup', '.produk, .qty', hitungTotal);

$('#addRow').click(function () {
    $('#produkTable tbody').append(`
        <tr>
            <td>
                <select name="produk[]" class="form-control produk">
                    <option value="">-- Pilih Produk --</option>
                    @foreach($produks as $produk)
                        <option value="{{ $produk->id }}" data-harga="{{ $produk->harga }}">
                            {{ $produk->nama_produk }} (Rp {{ number_format($produk->harga,0,',','.') }})
                        </option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" name="jumlah[]" class="form-control qty" value="1" min="1"></td>
            <td class="subtotal text-end">Rp 0</td>
            <td class="text-center"><button type="button" class="btn btn-danger btn-sm removeRow">❌</button></td>
        </tr>
    `);
});

$(document).on('click', '.removeRow', function () {
    $(this).closest('tr').remove();
    hitungTotal();
});
</script>

</body>
</html>
@endsection
