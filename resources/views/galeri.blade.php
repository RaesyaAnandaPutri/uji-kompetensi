<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri - SMKN 4 Kota Bogor</title>

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
            background-color: #ffffff;
            color: #1e293b;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header Title */
        .page-header h1 {
            font-size: 2.25rem;
            font-weight: 800;
            letter-spacing: -0.025em;
            color: #0f172a;
            text-transform: uppercase;
        }

        .page-header p {
            color: #64748b;
            font-size: 0.95rem;
            font-weight: 500;
        }

        /* Search Bar Input Styling */
        .search-container {
            max-width: 320px;
            width: 100%;
        }

        .search-input-group .form-control {
            border: 1px solid #e2e8f0;
            background-color: #f8fafc;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .search-input-group .form-control:focus {
            background-color: #ffffff;
            border-color: #0d6efd;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
        }

        .search-input-group .input-group-text {
            border: 1px solid #e2e8f0;
            background-color: #f8fafc;
            color: #94a3b8;
        }

        /* Card Custom Styling */
        .card-galeri {
            border: 1px solid #f1f5f9;
            border-radius: 16px;
            overflow: hidden;
            background-color: #ffffff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card-galeri:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -6px rgba(0, 0, 0, 0.08);
        }

        .card-galeri-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
        }

        .card-galeri-body {
            padding: 1.25rem;
            position: relative;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 110px;
        }

        .card-galeri-title {
            font-size: 1rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 0.5rem;
            line-height: 1.3;
        }

        .card-galeri-date {
            font-size: 0.825rem;
            font-weight: 600;
            color: #94a3b8;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* Ikon Unduh (kecil, tanpa latar) */
        .btn-unduh {
            display: inline-block;
            color: #64748b;
            font-size: 1rem;
            line-height: 1;
            padding: 4px 6px 4px 0;
            text-decoration: none;
            transition: color 0.2s ease, transform 0.2s ease;
        }

        .btn-unduh:hover {
            color: #0d6efd;
            transform: translateY(-1px);
        }

        /* Badge Kategori */
        .badge-kategori {
            position: absolute;
            right: 1.25rem;
            bottom: 1.25rem;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 8px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .badge-kegiatan { background-color: #eff6ff; color: #1d4ed8; }
        .badge-acara { background-color: #e0f2fe; color: #0284c7; }
        .badge-ekstrakurikuler { background-color: #fef3c7; color: #d97706; }
    </style>
</head>
<body>

    <!-- NAVBAR PARTIAL -->
    @include('partials.navbar')

    <!-- MAIN CONTENT -->
    <main class="container py-5 flex-grow-1">

        <!-- Header Title & Search Bar Row -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">
            <div class="page-header">
                <h1 class="mb-2">GALERI</h1>
                <p class="mb-0">Dokumentasi kegiatan dan momen terbaik di SMKN 4 Kota Bogor</p>
            </div>

            <!-- Search Bar (Kanan Atas) -->
            <div class="search-container">
                <div class="input-group search-input-group">
                    <span class="input-group-text border-end-0 rounded-start-3 ps-3">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="text" id="searchInput" onkeyup="filterGallery()" class="form-control border-start-0 rounded-end-3 py-2" placeholder="Cari galeri foto...">
                </div>
            </div>
        </div>

        <!-- Category Filter Buttons -->
        <div class="row row-cols-2 row-cols-sm-4 g-2 mb-4">
            <div class="col">
                <button onclick="filterGallery('semua')" id="btn-semua" class="btn btn-primary w-100 fw-bold py-2 rounded-3 shadow-sm filter-btn">
                    Semua
                </button>
            </div>
            <div class="col">
                <button onclick="filterGallery('kegiatan')" id="btn-kegiatan" class="btn btn-light border text-secondary w-100 fw-bold py-2 rounded-3 filter-btn">
                    Kegiatan
                </button>
            </div>
            <div class="col">
                <button onclick="filterGallery('acara')" id="btn-acara" class="btn btn-light border text-secondary w-100 fw-bold py-2 rounded-3 filter-btn">
                    Acara
                </button>
            </div>
            <div class="col">
                <button onclick="filterGallery('ekstrakurikuler')" id="btn-ekstrakurikuler" class="btn btn-light border text-secondary w-100 fw-bold py-2 rounded-3 filter-btn">
                    Ekstrakurikuler
                </button>
            </div>
        </div>

        <!-- Cards Grid -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4" id="card-container">

            @if(isset($galeriList) && count($galeriList) > 0)
                @foreach ($galeriList as $item)
                    <div class="col card-item" data-category="{{ strtolower($item->kategori) }}">
                        <div class="card-galeri">
                            <!-- Panggil Gambar Langsung dari public_path -->
                            <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}" class="card-galeri-img">

                            <div class="card-galeri-body">
                                <div>
                                    <div class="card-galeri-title">{{ $item->judul }}</div>
                                    <div class="card-galeri-date">
                                        <i class="fa-regular fa-calendar"></i>
                                        <span>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</span>
                                    </div>
                                </div>

                                <!-- Ikon Unduh Foto -->
                                <div class="mt-2">
                                    <a href="{{ route('galeri.unduh', $item->id) }}"
                                       class="btn-unduh"
                                       title="Unduh foto"
                                       aria-label="Unduh foto {{ $item->judul }}">
                                        <i class="fa-solid fa-download"></i>
                                    </a>
                                </div>

                                <span class="badge-kategori badge-{{ strtolower($item->kategori) }}">
                                    {{ ucfirst($item->kategori) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Tampilan jika tidak ada data galeri -->
                <div class="col-12 w-100 text-center py-5">
                    <div class="text-muted">
                        <i class="fa-regular fa-image fa-3x mb-3 text-secondary"></i>
                        <p class="fw-semibold fs-5 mb-1 text-dark">Belum Ada Galeri</p>
                        <p class="small text-muted">Belum ada foto galeri yang dipublikasikan.</p>
                    </div>
                </div>
            @endif

            <!-- Pesan saat pencarian tidak ditemukan via JavaScript -->
            <div class="col-12 w-100 text-center py-5 d-none" id="no-search-results">
                <div class="text-muted">
                    <i class="fa-solid fa-magnifying-glass fa-3x mb-3 text-secondary"></i>
                    <p class="fw-semibold fs-5 mb-1 text-dark">Tidak Ditemukan</p>
                    <p class="small text-muted">Tidak ada galeri yang cocok dengan pencarian Anda.</p>
                </div>
            </div>

        </div>
    </main>

    <!-- FOOTER PARTIAL -->
    @include('partials.footer')

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SCRIPT FILTERING & SEARCH -->
    <script>
        let currentCategory = 'semua';

        function filterGallery(category = null) {
            if (category !== null) {
                currentCategory = category;

                // Update Style Tombol Kategori
                const buttons = document.querySelectorAll('.filter-btn');
                buttons.forEach(btn => {
                    btn.classList.remove('btn-primary', 'shadow-sm');
                    btn.classList.add('btn-light', 'border', 'text-secondary');
                });

                const activeBtn = document.getElementById(`btn-${category}`);
                if (activeBtn) {
                    activeBtn.classList.remove('btn-light', 'border', 'text-secondary');
                    activeBtn.classList.add('btn-primary', 'shadow-sm');
                }
            }

            // Ambil Kata Kunci Search
            const searchQuery = document.getElementById('searchInput').value.toLowerCase().trim();
            const cards = document.querySelectorAll('.card-item');
            let visibleCount = 0;

            cards.forEach(card => {
                const cardCategory = card.getAttribute('data-category');
                const cardTitle = card.querySelector('.card-galeri-title').textContent.toLowerCase();

                const matchCategory = (currentCategory === 'semua' || cardCategory === currentCategory);
                const matchSearch = cardTitle.includes(searchQuery);

                if (matchCategory && matchSearch) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Tampilkan pesan "Tidak Ditemukan" jika tidak ada item yang cocok
            const noResults = document.getElementById('no-search-results');
            if (noResults) {
                if (visibleCount === 0 && cards.length > 0) {
                    noResults.classList.remove('d-none');
                } else {
                    noResults.classList.add('d-none');
                }
            }
        }
    </script>
</body>
</html>