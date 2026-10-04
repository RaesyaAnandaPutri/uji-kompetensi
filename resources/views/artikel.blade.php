<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel & Berita - SMKN 4 Kota Bogor</title>
    
    <!-- Favicon Sekolah -->
    <link rel="icon" type="image/png" href="https://upload.wikimedia.org/wikipedia/commons/9/9f/Logo_SMK_Negeri_4_Bogor.png">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
            color: #1f2937;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Hover Effect untuk Card Artikel */
        .card-article {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .card-article:hover {
            transform: translateY(-4px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
        }

        /* BADGE KATEGORI DINAMIS */
        .badge-berita, .badge-pengumuman {
            background-color: #eff6ff !important;
            color: #1d4ed8 !important; /* Biru */
        }

        .badge-prestasi {
            background-color: #ecfdf5 !important;
            color: #047857 !important; /* Hijau */
        }

        .badge-edukasi, .badge-kegiatan {
            background-color: #fffbeb !important;
            color: #b45309 !important; /* Oranye/Cokelat */
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body>

    <!-- NAVBAR PARTIAL -->
    @include('partials.navbar')

    <!-- MAIN CONTENT -->
    <main class="container py-5 flex-grow-1">
        
        <!-- Header Title -->
        <div class="mb-4">
            <h1 class="fw-extrabold text-dark display-6 mb-1" style="font-weight: 800;">ARTIKEL & BERITA</h1>
            <p class="text-muted small fw-medium mb-0">Informasi terbaru, kegiatan, dan prestasi dari SMKN 4 Kota Bogor</p>
        </div>

        <!-- Search & Filter Bar -->
        <div class="row g-3 mb-4 align-items-center">
            <!-- Filter Categories -->
            <div class="col-lg-8">
                <div class="row row-cols-2 row-cols-sm-4 g-2">
                    <div class="col">
                        <button onclick="filterArticle('semua')" id="btn-semua" class="btn btn-primary w-100 fw-bold py-2 rounded-3 shadow-sm filter-btn">
                            Semua
                        </button>
                    </div>
                    <div class="col">
                        <button onclick="filterArticle('pengumuman')" id="btn-pengumuman" class="btn btn-light border text-secondary w-100 fw-bold py-2 rounded-3 filter-btn">
                            Pengumuman
                        </button>
                    </div>
                    <div class="col">
                        <button onclick="filterArticle('kegiatan')" id="btn-kegiatan" class="btn btn-light border text-secondary w-100 fw-bold py-2 rounded-3 filter-btn">
                            Kegiatan
                        </button>
                    </div>
                    <div class="col">
                        <button onclick="filterArticle('prestasi')" id="btn-prestasi" class="btn btn-light border text-secondary w-100 fw-bold py-2 rounded-3 filter-btn">
                            Prestasi
                        </button>
                    </div>
                </div>
            </div>

            <!-- Search Input -->
            <div class="col-lg-4">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 rounded-start-3 text-muted ps-3">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="text" id="search-input" onkeyup="searchArticle()" class="form-control border-start-0 rounded-end-3 py-2 text-sm shadow-none" placeholder="Cari artikel...">
                </div>
            </div>
        </div>

        <!-- Cards Grid (Dinamis dari Database) -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="card-container">

            @forelse ($artikels as $item)
                @php
                    // Penentuan CSS Class Badge berdasarkan kategori dari database
                    $kategoriClean = strtolower($item->kategori);
                    $badgeClass = match($kategoriClean) {
                        'pengumuman', 'berita' => 'badge-berita',
                        'prestasi'             => 'badge-prestasi',
                        'kegiatan', 'edukasi'  => 'badge-edukasi',
                        default                => 'bg-secondary-subtle text-secondary'
                    };
                @endphp

                <div class="col card-item" data-category="{{ $kategoriClean }}">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden card-article">
                        <!-- Gambar Artikel -->
                        <img src="{{ asset($item->gambar) }}" 
                             alt="{{ $item->judul }}" 
                             class="card-img-top object-fit-cover" 
                             style="height: 13rem;"
                             onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=900&auto=format&fit=crop';">
                        
                        <div class="card-body d-flex flex-column justify-content-between p-4">
                            <div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="badge {{ $badgeClass }} fw-bold text-uppercase px-3 py-2 rounded-2" style="font-size: 0.625rem; letter-spacing: 0.05em;">
                                        {{ $item->kategori }}
                                    </span>
                                    <span class="text-muted small" style="font-size: 0.75rem;">
                                        <i class="fa-regular fa-calendar me-1"></i>
                                        {{ \Carbon\Carbon::parse($item->tanggal ?? $item->created_at)->translatedFormat('d M Y') }}
                                    </span>
                                </div>
                                <h5 class="card-title fw-bold text-dark fs-6 mb-2 line-clamp-2">{{ $item->judul }}</h5>
                                <p class="card-text text-muted small line-clamp-3 mb-3">
                                    {{ Str::limit(strip_tags($item->isi ?? $item->deskripsi ?? ''), 120) }}
                                </p>
                            </div>
                            <div class="pt-2 border-top mt-auto d-flex align-items-center justify-content-between">
                                <span class="text-muted small" style="font-size: 0.75rem;">
                                    <i class="fa-regular fa-user me-1"></i>{{ $item->penulis ?? 'Admin' }}
                                </span>
                                <a href="{{ route('detail-artikel', $item->id) }}" class="text-primary fw-bold text-decoration-none small">
                                    Baca <i class="fa-solid fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Tampilan jika tidak ada data artikel -->
                <div class="col-12 w-100 text-center py-5">
                    <div class="text-muted">
                        <i class="fa-regular fa-folder-open fa-3x mb-3 text-secondary"></i>
                        <p class="fw-semibold fs-5 mb-1">Belum Ada Artikel</p>
                        <p class="small">Artikel belum ditambahkan oleh Administrator.</p>
                    </div>
                </div>
            @endforelse

        </div>

        <!-- Notifikasi Pencarian Tidak Ditemukan (JS Client Side) -->
        <div id="no-results" class="text-center py-5 d-none">
            <i class="fa-solid fa-magnifying-glass fa-3x mb-3 text-muted"></i>
            <h5 class="fw-bold text-dark mb-1">Artikel Tidak Ditemukan</h5>
            <p class="text-muted small">Coba gunakan kata kunci atau kategori yang berbeda.</p>
        </div>

    </main>

    <!-- FOOTER PARTIAL -->
    @include('partials.footer')

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SCRIPT FILTERING & SEARCH -->
    <script>
        let currentCategory = 'semua';

        function filterArticle(category) {
            currentCategory = category;

            // Reset style button
            const buttons = document.querySelectorAll('.filter-btn');
            buttons.forEach(btn => {
                btn.classList.remove('btn-primary', 'shadow-sm');
                btn.classList.add('btn-light', 'border', 'text-secondary');
            });

            // Set active style button
            const activeBtn = document.getElementById(`btn-${category}`);
            if (activeBtn) {
                activeBtn.classList.remove('btn-light', 'border', 'text-secondary');
                activeBtn.classList.add('btn-primary', 'shadow-sm');
            }

            applyFilters();
        }

        function searchArticle() {
            applyFilters();
        }

        function applyFilters() {
            const searchQuery = document.getElementById('search-input').value.toLowerCase();
            const cards = document.querySelectorAll('.card-item');
            let visibleCount = 0;

            cards.forEach(card => {
                const category = card.getAttribute('data-category');
                const title = card.querySelector('.card-title').innerText.toLowerCase();
                const desc = card.querySelector('.card-text').innerText.toLowerCase();

                const matchesCategory = (currentCategory === 'semua' || category === currentCategory);
                const matchesSearch = title.includes(searchQuery) || desc.includes(searchQuery);

                if (matchesCategory && matchesSearch) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Tampilkan pesan "tidak ditemukan" jika tidak ada item yang cocok
            const noResults = document.getElementById('no-results');
            if (visibleCount === 0 && cards.length > 0) {
                noResults.classList.remove('d-none');
            } else {
                noResults.classList.add('d-none');
            }
        }
    </script>
</body>
</html>