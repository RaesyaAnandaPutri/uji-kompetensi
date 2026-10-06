<aside class="admin-sidebar">
    <div>
        <!-- Logo Sekolah -->
        <div class="d-flex align-items-center gap-3 px-2 mb-4">
            <!-- Disesuaikan ke logo_smkn_4.png -->
            <img src="{{ asset('storage/logo smkn 4.png') }}" alt="Logo SMKN 4 Bogor" width="40" height="40" class="object-fit-contain">
            <div>
                <span class="brand-title">SMKN 4</span>
                <span class="brand-subtitle">KOTA BOGOR</span>
            </div>
        </div>

        <!-- Menu Navigasi -->
        <nav class="d-flex flex-column gap-2">
            <a href="{{ url('/admin/dashboard') }}"
               class="sidebar-nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ url('/admin/galeri') }}"
               class="sidebar-nav-link {{ request()->is('admin/galeri*') ? 'active' : '' }}">
                <i class="fa-solid fa-images"></i>
                <span>Galeri</span>
            </a>

            <a href="{{ url('/admin/artikel') }}"
               class="sidebar-nav-link {{ request()->is('admin/artikel*') ? 'active' : '' }}">
                <i class="fa-solid fa-newspaper"></i>
                <span>Artikel</span>
            </a>

            <a href="{{ url('/admin/produk') }}"
               class="sidebar-nav-link {{ request()->is('admin/produk*') ? 'active' : '' }}">
                <i class="fa-solid fa-award"></i>
                <span>Produk</span>
            </a>

            @php $belumDibaca = \App\Models\Pesan::where('is_read', false)->count(); @endphp
            <a href="{{ url('/admin/pesan') }}"
               class="sidebar-nav-link {{ request()->is('admin/pesan*') ? 'active' : '' }}">
                <i class="fa-solid fa-envelope"></i>
                <span>Pesan</span>
                @if ($belumDibaca > 0)
                    <span class="badge bg-danger rounded-pill ms-auto">{{ $belumDibaca }}</span>
                @endif
            </a>
        </nav>
    </div>

    <!-- Footer Sidebar -->
    <div class="px-2 mt-4">
        <form action="{{ route('logout') }}" method="POST" class="mb-3">
            @csrf
            <button type="submit" class="sidebar-nav-link border-0 bg-transparent w-100 text-start text-danger">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Logout</span>
            </button>
        </form>
        <span class="sidebar-footer-text">SMKN 4 Kota Bogor &copy; 2026</span>
    </div>
</aside>