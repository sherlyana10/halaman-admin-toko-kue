@extends('layouts.dashboard')

@section('content')
<h4>📊 Laporan Penjualan</h4>

<form method="GET" class="row g-3 mb-4">
    <div class="col-md-4">
        <label>Tanggal Awal</label>
        <input type="date" name="tanggal_awal" class="form-control" required>
    </div>

    <div class="col-md-4">
        <label>Tanggal Akhir</label>
        <input type="date" name="tanggal_akhir" class="form-control" required>
    </div>

    <div class="col-md-4 d-flex align-items-end">
        <button class="btn btn-primary w-100">🔍 Tampilkan</button>
    </div>
</form>

@if(count($transaksis))
<div class="card">
    <div class="card-body">

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksis as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->pelanggan->nama_pelanggan }}</td>
                    <td>Rp {{ number_format($item->total_harga,0,',','.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="alert alert-success text-end">
            <strong>Total Penjualan:</strong>
           Rp {{ number_format($total,0,',','.') }}


        </div>

    </div>
</div>
@endif
@endsection
