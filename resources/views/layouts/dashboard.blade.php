<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin Toko Kue</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #fff0f6;
}

/* SIDEBAR */
.sidebar {
    min-height: 100vh;
    width: 240px;
    background: linear-gradient(180deg, #ff5da2, #ff85b3);
    box-shadow: 4px 0 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.sidebar.hide {
    margin-left: -240px;
}

.sidebar h4 {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
}

.sidebar .nav-link {
    color: #ffe6f0;
    font-weight: 500;
    margin: 4px 10px;
    border-radius: 12px;
    padding: 10px 14px;
}

.sidebar .nav-link.active,
.sidebar .nav-link:hover {
    background: #fff;
    color: #ff5da2;
}

/* TOP NAVBAR */
.topbar {
    background: #fff;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}

.toggle-btn {
    border: none;
    background: transparent;
    font-size: 26px;
    color: #ff5da2;
}

/* MAIN */
.main-content {
    transition: all 0.3s ease;
}

.card {
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(255,93,162,0.15);
}
</style>

</head>
<body>

<div class="d-flex">

    <!-- SIDEBAR -->
    <nav id="sidebar" class="sidebar p-4">
        <h4 class="text-white text-center mb-4">Toko Kue</h4>

        <ul class="nav flex-column">

            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/dashboard')) active @endif" href="/admin/dashboard">
                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/kategori*')) active @endif" href="/admin/kategori">
                    <i class="bi bi-tags-fill me-2"></i>Kategori
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/produk*')) active @endif" href="/admin/produk">
                    <i class="bi bi-cupcake me-2"></i>Produk
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/pelanggan*')) active @endif" href="/admin/pelanggan">
                    <i class="bi bi-person-fill me-2"></i>Pelanggan
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/transaksi*')) active @endif" href="/admin/transaksi">
                    <i class="bi bi-bag-fill me-2"></i>Transaksi
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(request()->is('admin/laporan*')) active @endif" href="/admin/laporan">
                    <i class="bi bi-file-earmark-text-fill me-2"></i>Laporan Penjualan
                </a>
            </li>

            <li class="nav-item mt-4">
                <form method="POST" action="/logout">
                    @csrf
                    <button class="btn btn-outline-light w-100">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </button>
                </form>
            </li>

        </ul>
    </nav>

    <!-- MAIN AREA -->
    <div class="flex-grow-1 main-content">

        <!-- TOPBAR -->
        <nav class="navbar topbar px-4">
            <button id="toggleSidebar" class="toggle-btn">
                <i class="bi bi-list"></i>
            </button>
            <span class="fw-semibold text-muted">Admin Dashboard</span>
        </nav>

        <!-- PAGE CONTENT -->
        <main class="p-4">
            @yield('content')
        </main>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- TOGGLE SIDEBAR -->
<script>
document.getElementById('toggleSidebar').addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('hide');
});
</script>

</body>
</html>
