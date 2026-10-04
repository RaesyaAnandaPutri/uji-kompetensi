<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - SMKN 4 Kota Bogor</title>

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

        /* Page Title Header */
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

        /* Card Custom Styling */
        .card-produk {
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

        .card-produk:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -6px rgba(0, 0, 0, 0.08);
        }

        .card-produk-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
        }

        .card-produk-body {
            padding: 1.25rem;
            position: relative;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 110px;
        }

        .card-produk-title {
            font-size: 1rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 0.5rem;
            line-height: 1.3;
        }

        .card-produk-date {
            font-size: 0.825rem;
            font-weight: 600;
            color: #94a3b8;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* Badge Kategori Jurusan */
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

        .badge-pplg { background-color: #eff6ff; color: #1d4ed8; }
        .badge-tjkt { background-color: #e0f2fe; color: #0284c7; }
        .badge-tpfl { background-color: #fef3c7; color: #d97706; }
        .badge-to { background-color: #f3e8ff; color: #7e22ce; }
    </style>
</head>
<body>

    <!-- NAVBAR PARTIAL -->
    @include('partials.navbar')

    <!-- MAIN CONTENT -->
    <main class="container py-5 flex-grow-1">

        <!-- Header Title -->
        <div class="page-header mb-4">
            <h1 class="mb-2">PRODUK SISWA</h1>
            <p class="mb-0">Hasil karya, produk inovatif, dan proyek kreatif buatan siswa SMKN 4 Kota Bogor</p>
        </div>

        <!-- Category Filter Buttons -->
        <div class="row row-cols-2 row-cols-sm-5 g-2 mb-4">
            <div class="col">
                <button onclick="filterProduk('semua')" id="btn-semua" class="btn btn-primary w-100 fw-bold py-2 rounded-3 shadow-sm filter-btn">
                    Semua
                </button>
            </div>
            <div class="col">
                <button onclick="filterProduk('pplg')" id="btn-pplg" class="btn btn-light border text-secondary w-100 fw-bold py-2 rounded-3 filter-btn">
                    PPLG
                </button>
            </div>
            <div class="col">
                <button onclick="filterProduk('tjkt')" id="btn-tjkt" class="btn btn-light border text-secondary w-100 fw-bold py-2 rounded-3 filter-btn">
                    TJKT
                </button>
            </div>
            <div class="col">
                <button onclick="filterProduk('tpfl')" id="btn-tpfl" class="btn btn-light border text-secondary w-100 fw-bold py-2 rounded-3 filter-btn">
                    TPFL
                </button>
            </div>
            <div class="col">
                <button onclick="filterProduk('to')" id="btn-to" class="btn btn-light border text-secondary w-100 fw-bold py-2 rounded-3 filter-btn">
                    TO
                </button>
            </div>
        </div>

        @php
            // Nomor WhatsApp admin (awalan 62, tanpa +, spasi, atau strip)
            $noWa = '6283183921389';
        @endphp

        <!-- Cards Grid -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4" id="card-container">

            @forelse ($produks as $item)
                @php
                    $pesan = "Halo, saya tertarik dengan produk *{$item->judul}* dari website SMKN 4 Kota Bogor. Boleh minta informasi lebih lanjut?";
                    $linkWa = 'https://wa.me/' . $noWa . '?text=' . rawurlencode($pesan);
                @endphp

                <div class="col card-item" data-category="{{ strtolower($item->kategori) }}">
                    <!-- Seluruh kartu bisa diklik menuju WhatsApp -->
                    <a href="{{ $linkWa }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none text-dark">
                        <div class="card-produk">
                            <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}" class="card-produk-img">

                            <div class="card-produk-body">
                                <div>
                                    <div class="card-produk-title">{{ $item->judul }}</div>
                                    <div class="card-produk-date mb-3">
                                        <i class="fa-regular fa-calendar"></i>
                                        <span>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <span class="badge-kategori badge-{{ strtolower($item->kategori) }}">
                                        {{ strtoupper($item->kategori) }}
                                    </span>

                                    <!-- Tombol WhatsApp -->
                                    <span class="btn btn-sm btn-success rounded-pill px-3 fw-bold">
                                        <i class="fa-brands fa-whatsapp me-1"></i> Pesan
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 w-100 text-center py-5">
                    <div class="text-muted">
                        <i class="fa-solid fa-box-open fa-3x mb-3 text-secondary"></i>
                        <p class="fw-semibold fs-5 mb-1 text-dark">Belum Ada Produk</p>
                        <p class="small text-muted">Belum ada karya atau produk siswa yang dipublikasikan.</p>
                    </div>
                </div>
            @endforelse

        </div>
    </main>

    <!-- FOOTER PARTIAL -->
    @include('partials.footer')

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SCRIPT FILTERING -->
    <script>
        function filterProduk(category) {
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

            const cards = document.querySelectorAll('.card-item');
            cards.forEach(card => {
                if (category === 'semua' || card.getAttribute('data-category') === category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>