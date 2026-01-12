<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Transaksi</title>

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

        /* Info box */
        .info-box {
            background: #ffffff;
            border-radius: 16px;
            padding: 16px 20px;
            box-shadow: 0 10px 25px rgba(255,93,162,0.18);
            margin-bottom: 20px;
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

        .table-secondary {
            background-color: #ffd6e8 !important;
        }

        /* Badge */
        .badge.bg-success {
            background: #ff5da2 !important;
        }

        .badge.bg-warning {
            background: #ffd6e8 !important;
            color: #ff2f92 !important;
        }

        /* Button */
        .btn-secondary {
            border-radius: 12px;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h4>📄 Detail Transaksi</h4>

    <div class="info-box">
        <strong>Pelanggan:</strong> {{ $transaksi->pelanggan->nama_pelanggan ?? '-' }} <br>
        <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d-m-Y') }} <br>
        <strong>Status:</strong>
        @if($transaksi->status == 'lunas')
            <span class="badge bg-success">Lunas</span>
        @else
            <span class="badge bg-warning">Pending</span>
        @endif
    </div>

    <table class="table table-bordered table-striped">
        <thead class="text-center">
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

    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">⬅️ Kembali</a>
</div>

</body>
</html>
