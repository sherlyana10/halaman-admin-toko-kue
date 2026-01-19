@extends('layouts.dashboard')

@section('content')
<!-- Judul Halaman -->
<h1 class="mb-4">Selamat Datang, Admin!</h1>
<p>Ini adalah dashboard admin Toko Kue. Semua menu dan data sesuai route yang ada.</p>

<!-- Cards Ringkasan -->
<div class="row g-4 mt-3">
  
  <!-- Kategori -->
  <div class="col-md-3">
    <div class="card text-white bg-success card-hover">
      <div class="card-body d-flex align-items-center">
        <i class="bi bi-tags-fill fs-1 me-3"></i>
        <div>
          <h5>Kategori</h5>
          <p class="fs-5">{{ \App\Models\Kategori::count() }} data</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Produk -->
  <div class="col-md-3">
    <div class="card text-white bg-warning card-hover">
      <div class="card-body d-flex align-items-center">
        <i class="bi bi-cupcake fs-1 me-3"></i>
        <div>
          <h5>Produk</h5>
          <p class="fs-5">{{ \App\Models\Produk::count() }} data</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Pelanggan -->
  <div class="col-md-3">
    <div class="card text-white bg-danger card-hover">
      <div class="card-body d-flex align-items-center">
        <i class="bi bi-person-fill fs-1 me-3"></i>
        <div>
          <h5>Pelanggan</h5>
          <p class="fs-5">{{ \App\Models\Pelanggan::count() }} data</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Transaksi -->
  <div class="col-md-3">
    <div class="card text-white bg-info card-hover">
      <div class="card-body d-flex align-items-center">
        <i class="bi bi-bag-fill fs-1 me-3"></i>
        <div>
          <h5>Transaksi</h5>
          <p class="fs-5">{{ \App\Models\Transaksi::count() }} data</p>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
