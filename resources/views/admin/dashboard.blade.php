<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin Toko Kue</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: #fff0f6;
  }

  /* Sidebar */
  .sidebar {
    min-height: 100vh;
    background: linear-gradient(180deg, #ff5da2, #ff85b3);
    box-shadow: 4px 0 15px rgba(0,0,0,0.08);
  }

  .sidebar h4 {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    letter-spacing: 1px;
  }

  .sidebar .nav-link {
    color: #ffe6f0;
    font-weight: 500;
    margin: 4px 10px;
    border-radius: 12px;
    padding: 10px 14px;
    transition: all 0.3s ease;
  }

  .sidebar .nav-link.active,
  .sidebar .nav-link:hover {
    background-color: #ffffff;
    color: #ff5da2;
  }

  /* Main */
  main h1 {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    color: #ff5da2;
  }

  main p {
    color: #6c757d;
  }

  /* Cards */
  .card {
    border: none;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(255,93,162,0.15);
  }

  .card-hover {
    transition: all 0.3s ease;
  }

  .card-hover:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 40px rgba(255,93,162,0.25);
  }

  .card h5 {
    font-weight: 600;
  }

  /* Custom Pink Cards */
  .bg-success {
    background: linear-gradient(135deg, #ff85b3, #ff5da2) !important;
  }

  .bg-warning {
    background: linear-gradient(135deg, #ffd6e8, #ff85b3) !important;
    color: #fff;
  }

  .bg-danger {
    background: linear-gradient(135deg, #ff5da2, #ff2f92) !important;
  }

  .bg-info {
    background: linear-gradient(135deg, #ffc1dd, #ff5da2) !important;
  }

  /* Logout button */
  .sidebar button {
    border-radius: 14px;
    font-weight: 500;
  }
</style>


</head>
<body>
<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <nav class="col-md-2 d-none d-md-block sidebar py-4">
      <div class="position-sticky">
        <h4 class="text-white text-center mb-4">Toko Kue</h4>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="/admin/kategori"><i class="bi bi-tags-fill me-2"></i>Kategori</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/produk"><i class="bi bi-cupcake me-2"></i>Produk</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/pelanggan"><i class="bi bi-person-fill me-2"></i>Pelanggan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/transaksi"><i class="bi bi-bag-fill me-2"></i>Transaksi</a>
          </li>
          <li class="nav-item mt-3">
            <form method="POST" action="/logout">
              @csrf
              <button class="btn btn-outline-light w-100"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
            </form>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="col-md-10 ms-sm-auto px-md-4 py-4">
      <h1 class="mb-4">Selamat Datang, Admin!</h1>
      <p>Ini adalah dashboard admin Toko Kue. Semua menu dan data sesuai route yang ada.</p>

      <!-- Cards Ringkasan -->
      <div class="row g-4 mt-3">
        <div class="col-md-3">
          <div class="card text-white bg-success card-hover">
            <div class="card-body d-flex align-items-center">
              <i class="bi bi-tags-fill fs-1 me-3"></i>
              <div>
                <h5 class="card-title">Kategori</h5>
                <p class="card-text fs-5">{{ \App\Models\Kategori::count() }} data</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-white bg-warning card-hover">
            <div class="card-body d-flex align-items-center">
              <i class="bi bi-cupcake fs-1 me-3"></i>
              <div>
                <h5 class="card-title">Produk</h5>
                <p class="card-text fs-5">{{ \App\Models\Produk::count() }} data</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-white bg-danger card-hover">
            <div class="card-body d-flex align-items-center">
              <i class="bi bi-person-fill fs-1 me-3"></i>
              <div>
                <h5 class="card-title">Pelanggan</h5>
                <p class="card-text fs-5">{{ \App\Models\Pelanggan::count() }} data</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-white bg-info card-hover">
            <div class="card-body d-flex align-items-center">
              <i class="bi bi-bag-fill fs-1 me-3"></i>
              <div>
                <h5 class="card-title">Transaksi</h5>
                <p class="card-text fs-5">{{ \App\Models\Transaksi::count() }} data</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </main>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
