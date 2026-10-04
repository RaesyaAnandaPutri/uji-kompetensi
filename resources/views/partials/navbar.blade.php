<!-- Bootstrap 5 CSS CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<nav class="navbar navbar-expand-lg bg-white sticky-top shadow-sm border-bottom py-2">
    <div class="container">
        <!-- Logo & Brand -->
        <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center gap-2 py-0">
            <img src="{{ asset('storage/logo smkn 4.png') }}" alt="Logo SMKN 4 Bogor" width="40" height="40" class="object-fit-contain">
            <div class="lh-sm">
                <span class="d-block fw-extrabold text-navy small" style="color: #1e3a8a; font-weight: 800; letter-spacing: 0.025em;">SMKN 4</span>
                <span class="d-block fw-bold text-navy" style="color: #1e3a8a; font-size: 0.75rem; letter-spacing: 0.05em;">KOTA BOGOR</span>
            </div>
        </a>

        <!-- Hamburger Button untuk Mobile -->
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links -->
        <div class="collapse navbar-collapse justify-content-end mt-3 mt-lg-0" id="navbarNav">
            <ul class="navbar-nav gap-lg-3 fw-medium">
                <li class="nav-item">
                    <a class="nav-link text-secondary-emphasis hover-primary" href="{{ url('/') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary-emphasis hover-primary" href="{{ url('/#tentang') }}">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary-emphasis hover-primary" href="{{ url('/galeri') }}">Galeri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary-emphasis hover-primary" href="{{ url('/artikel') }}">Artikel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary-emphasis hover-primary" href="{{ url('/produk') }}">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary-emphasis hover-primary" href="{{ url('/#kontak') }}">Kontak</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Custom Hover Effect & Style Adjustments -->
<style>
    .nav-link.hover-primary:hover {
        color: #1d4ed8 !important;
    }
</style>

<!-- Bootstrap 5 JS Bundle CDN (Diperlukan untuk fungsi toggle menu mobile) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>