<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h4>📄 Detail Transaksi</h4>

    <div class="mb-3">
        <strong>Pelanggan:</strong> {{ $transaksi->pelanggan->nama_pelanggan ?? '-' }} <br>
        <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d-m-Y') }} <br>
        <strong>Status:</strong> 
        @if($transaksi->status == 'lunas')
            <span class="badge bg-success">Lunas</span>
        @else
            <span class="badge bg-warning text-dark">Pending</span>
        @endif
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
            <tr>
                <th>No</th>
                <th>Kue / Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($transaksi->produk as $index => $item)
                @php $subtotal = $item->pivot->jumlah * $item->pivot->harga; @endphp
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_produk }}</td>
                    <td>Rp {{ number_format($item->pivot->harga,0,',','.') }}</td>
                    <td class="text-center">{{ $item->pivot->jumlah }}</td>
                    <td>Rp {{ number_format($subtotal,0,',','.') }}</td>
                </tr>
                @php $total += $subtotal; @endphp
            @endforeach
            <tr class="table-secondary">
                <td colspan="4" class="text-end"><strong>Total</strong></td>
                <td><strong>Rp {{ number_format($total,0,',','.') }}</strong></td>
            </tr>
        </tbody>
    </table>

    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
</div>
</body>
</html>
