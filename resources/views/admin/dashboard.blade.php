@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('styles')
<style>
    .stat-card {
        background-color: #ffffff;
        padding: 1.5rem;
        border-radius: 1.25rem;
        border: 1px solid #f1f5f9;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 100%;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    }

    .stat-label {
        font-size: 0.75rem;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.25rem;
    }

    .stat-value {
        font-size: 1.875rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 0.25rem;
        line-height: 1.2;
    }

    .stat-link {
        font-size: 0.75rem;
        font-weight: 700;
        color: #2563eb;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .stat-link:hover {
        color: #1d4ed8;
        text-decoration: underline;
    }

    .stat-icon {
        width: 3.5rem;
        height: 3.5rem;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .stat-icon-blue { background-color: #eff6ff; color: #2563eb; }
    .stat-icon-purple { background-color: #faf5ff; color: #9333ea; }
    .stat-icon-emerald { background-color: #ecfdf5; color: #059669; }

    .dashboard-card {
        background-color: #ffffff;
        padding: 1.5rem;
        border-radius: 1.25rem;
        border: 1px solid #f1f5f9;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        height: 100%;
    }

    .dashboard-card-title {
        font-size: 1rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 1.25rem;
    }

    .recent-content-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .recent-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 0.875rem;
        border-bottom: 1px solid #f8fafc;
    }

    .recent-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .recent-item-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .recent-item-thumb-img {
        width: 45px;
        height: 45px;
        object-fit: cover;
        border-radius: 8px;
    }

    .recent-item-thumb-placeholder {
        width: 45px;
        height: 45px;
        background-color: #f1f5f9;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
    }

    .recent-item-judul {
        font-size: 0.875rem;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 0.15rem;
        line-height: 1.3;
    }

    .recent-item-tanggal {
        font-size: 0.75rem;
        color: #94a3b8;
        font-weight: 600;
        white-space: nowrap;
    }

    .badge-content {
        display: inline-block;
        padding: 0.2rem 0.65rem;
        font-size: 0.65rem;
        font-weight: 700;
        border-radius: 50rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    .badge-galeri { background-color: #eff6ff; color: #2563eb; }
    .badge-acara { background-color: #ecfdf5; color: #059669; }
    .badge-artikel { background-color: #faf5ff; color: #9333ea; }

    .summary-table-header {
        display: flex;
        justify-content: space-between;
        font-size: 0.75rem;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #f1f5f9;
        margin-bottom: 1rem;
    }

    .summary-list {
        display: flex;
        flex-direction: column;
        gap: 0.875rem;
        font-size: 0.875rem;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .summary-category-name {
        font-weight: 600;
        color: #334155;
    }

    .summary-category-count {
        font-weight: 700;
        color: #0f172a;
        background-color: #f1f5f9;
        padding: 0.15rem 0.6rem;
        border-radius: 6px;
        font-size: 0.8rem;
    }
</style>
@endsection

@section('content')

<!-- HEADER TITLE -->
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h2 class="fw-bold mb-1" style="color: #0f172a;">Dashboard</h2>
        <p class="text-muted small mb-0">Ringkasan statistik dan aktivitas konten terbaru SMKN 4 Kota Bogor</p>
    </div>
    <div class="d-flex align-items-center gap-2">
        <div class="bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
            <i class="fa-solid fa-user-gear"></i>
        </div>
        <div class="text-start">
            <span class="d-block fw-bold text-dark" style="font-size: 0.9rem; line-height: 1.2;">{{ auth()->user()->name ?? 'Administrator' }}</span>
            <span class="text-muted" style="font-size: 0.75rem;">Admin Utama</span>
        </div>
    </div>
</div>

<!-- KARTU STATISTIK ATAS -->
<div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
    <div class="col">
        <div class="stat-card">
            <div>
                <p class="stat-label">Total Galeri</p>
                <h3 class="stat-value">{{ $totalGaleri }}</h3>
                <a href="{{ route('admin.galeri.index') ?? url('/admin/galeri') }}" class="stat-link">Lihat Semua <i class="fa-solid fa-arrow-right ms-1"></i></a>
            </div>
            <div class="stat-icon stat-icon-blue">
                <i class="fa-solid fa-images"></i>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="stat-card">
            <div>
                <p class="stat-label">Total Artikel</p>
                <h3 class="stat-value">{{ $totalArtikel }}</h3>
                <a href="{{ route('admin.artikel.index') ?? url('/admin/artikel') }}" class="stat-link">Lihat Semua <i class="fa-solid fa-arrow-right ms-1"></i></a>
            </div>
            <div class="stat-icon stat-icon-purple">
                <i class="fa-solid fa-newspaper"></i>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="stat-card">
            <div>
                <p class="stat-label">Total Produk</p>
                <h3 class="stat-value">{{ $totalProduk }}</h3>
                <a href="{{ route('admin.produk.index') ?? url('/admin/produk') }}" class="stat-link">Lihat Semua <i class="fa-solid fa-arrow-right ms-1"></i></a>
            </div>
            <div class="stat-icon stat-icon-emerald">
                <i class="fa-solid fa-box-open"></i>
            </div>
        </div>
    </div>
</div>

<!-- BAGIAN BAWAH: KONTEN TERBARU & RINGKASAN -->
<div class="row g-4">

    <!-- KONTEN TERBARU -->
    <div class="col-12 col-lg-8">
        <div class="dashboard-card">
            <h3 class="dashboard-card-title">Konten Terbaru</h3>

            <div class="recent-content-list">
                @forelse($kontenTerbaru as $item)
                <div class="recent-item">
                    <div class="recent-item-left">
                        @if(!empty($item['gambar']))
                            <img src="{{ asset($item['gambar']) }}" alt="{{ $item['judul'] }}" class="recent-item-thumb-img">
                        @else
                            <div class="recent-item-thumb-placeholder">
                                <i class="fa-regular fa-image"></i>
                            </div>
                        @endif
                        <div>
                            <h4 class="recent-item-judul">{{ $item['judul'] }}</h4>
                            <span class="badge-content {{ $item['badge'] }}">{{ $item['kategori'] }}</span>
                        </div>
                    </div>
                    <span class="recent-item-tanggal">
                        {{ \Carbon\Carbon::parse($item['tanggal'])->translatedFormat('d M Y') }}
                    </span>
                </div>
                @empty
                <div class="text-center py-4 text-muted">
                    <i class="fa-solid fa-folder-open fa-2x mb-2 text-secondary"></i>
                    <p class="small mb-0">Belum ada konten terbaru yang diunggah.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

<!-- RINGKASAN KATEGORI -->
    <div class="col-12 col-lg-4">
        <div class="dashboard-card">
            <h3 class="dashboard-card-title">Ringkasan Produk per Jurusan</h3>

            <div class="summary-table-header">
                <span>Kategori</span>
                <span>Jumlah</span>
            </div>

            <div class="summary-list">
                @forelse($ringkasanKategori as $row)
                <div class="summary-row">
                    <span class="summary-category-name">{{ strtoupper($row->kategori) }}</span>
                    <span class="summary-category-count">{{ $row->jumlah }}</span>
                </div>
                @empty
                <div class="summary-row">
                    <span class="summary-category-name text-muted">Belum ada data</span>
                    <span class="summary-category-count">0</span>
                </div>
                @endforelse
            </div>
        </div>
    </div>

</div>

@endsection