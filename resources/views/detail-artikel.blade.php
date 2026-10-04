<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $artikel->judul }} - SMKN 4 Kota Bogor</title>
    
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

        /* Badge Kategori Dinamis */
        .badge-berita, .badge-pengumuman {
            background-color: #eff6ff !important;
            color: #1d4ed8 !important;
        }

        .badge-prestasi {
            background-color: #ecfdf5 !important;
            color: #047857 !important;
        }

        .badge-edukasi, .badge-kegiatan {
            background-color: #fffbeb !important;
            color: #b45309 !important;
        }

        .article-content p {
            line-height: 1.8;
            color: #374151;
            margin-bottom: 1.25rem;
            font-size: 1.05rem;
        }
    </style>
</head>
<body>

    <!-- NAVBAR PARTIAL -->
    @include('partials.navbar')

    <!-- MAIN CONTENT -->
    <main class="container py-5 flex-grow-1">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                
                <!-- Tombol Kembali -->
                <div class="mb-4">
                    <a href="{{ route('artikel') }}" class="btn btn-light border fw-semibold text-secondary px-3 py-2 rounded-3 mb-3">
                        <i class="fa-solid fa-arrow-left me-2"></i>Kembali ke Artikel
                    </a>
                </div>

                @php
                    $kategoriClean = strtolower($artikel->kategori);
                    $badgeClass = match($kategoriClean) {
                        'pengumuman', 'berita' => 'badge-berita',
                        'prestasi'             => 'badge-prestasi',
                        'kegiatan', 'edukasi'  => 'badge-edukasi',
                        default                => 'bg-secondary-subtle text-secondary'
                    };
                    
                    // Otomatis mendeteksi nama kolom deskripsi/konten/isi
                    $kontenArtikel = $artikel->deskripsi ?? $artikel->konten ?? $artikel->isi ?? null;
                @endphp

                <!-- Header Artikel -->
                <div class="mb-4">
                    <div class="d-flex align-items-center gap-3 mb-3 flex-wrap">
                        <span class="badge {{ $badgeClass }} fw-bold text-uppercase px-3 py-2 rounded-2" style="font-size: 0.75rem;">
                            {{ $artikel->kategori }}
                        </span>
                        <span class="text-muted small">
                            <i class="fa-regular fa-calendar me-1"></i>
                            {{ \Carbon\Carbon::parse($artikel->tanggal ?? $artikel->created_at)->translatedFormat('d F Y') }}
                        </span>
                    </div>
                    
                    <!-- Judul Dinamis -->
                    <h1 class="fw-bold text-dark display-6 mb-3">{{ $artikel->judul }}</h1>
                </div>

                <!-- Gambar Utama Artikel -->
                @if($artikel->gambar)
                    <div class="mb-4 rounded-4 overflow-hidden shadow-sm">
                        <img src="{{ asset($artikel->gambar) }}" 
                             alt="{{ $artikel->judul }}" 
                             class="img-fluid w-100 object-fit-cover" 
                             style="max-height: 450px;"
                             onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=1200&auto=format&fit=crop';">
                    </div>
                @endif

                <!-- Isi Konten Artikel Dinamis -->
                <article class="article-content bg-white p-4 p-md-5 rounded-4 shadow-sm mb-5">
                    @if(!empty($kontenArtikel))
                        {!! nl2br(e($kontenArtikel)) !!}
                    @else
                        <p class="text-muted fst-italic mb-0">Deskripsi/konten artikel belum tersedia.</p>
                    @endif
                </article>

            </div>
        </div>
    </main>

    <!-- FOOTER PARTIAL -->
    @include('partials.footer')

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>