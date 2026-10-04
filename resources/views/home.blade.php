<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMKN 4 Kota Bogor - Website Resmi</title>
    <link rel="icon" type="image/png" href="https://upload.wikimedia.org/wikipedia/commons/9/9f/.png">

    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
            color: #1f2937;
        }

        /* Hero Section dengan Background Gradient Overlay */
        .hero-section {
            height: 520px;
            background-image: linear-gradient(rgba(15, 23, 42, 0.65), rgba(15, 23, 42, 0.65)), url('https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=1920&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }

        /* Stats Floating Effect */
        .stats-wrapper {
            margin-top: -3rem;
            position: relative;
            z-index: 20;
        }

        /* Styling Visi Misi Icon Box */
        .icon-box-lg {
            width: 3rem;
            height: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            flex-shrink: 0;
        }

        /* Garis bawah biru pada fasilitas */
        .fasilitas-card {
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
        }
        .fasilitas-card:hover {
            border-bottom: 3px solid #0d6efd;
            transform: translateY(-3px);
        }

        /* Custom Soft Colors untuk Icon Program */
        .bg-blue-soft { background-color: #eff6ff; color: #0d6efd; }
        .bg-amber-soft { background-color: #fef3c7; color: #d97706; }
        .bg-slate-soft { background-color: #f1f5f9; color: #334155; }

        /* Rating bintang */
        .star-rating {
            display: inline-flex;
            flex-direction: row-reverse;
            gap: 0.25rem;
        }
        .star-rating input { display: none; }
        .star-rating label {
            font-size: 1.75rem;
            color: #d1d5db;
            cursor: pointer;
            transition: color 0.15s ease;
        }
        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #f59e0b;
        }
    </style>
</head>
<body>

    <!-- Memanggil Navbar dari partials -->
    @include('partials.navbar')

    <!-- HERO SECTION -->
    <section id="beranda" class="hero-section d-flex align-items-center text-white"
             style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('storage/sekolah bg.JPG') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h1 class="display-4 fw-bold lh-1 mb-3">
                        SMK NEGERI 4<br>KOTA BOGOR
                    </h1>
                    <p class="lead text-light mb-4">Sekolah Pusat Keunggulan</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#program" class="btn btn-primary px-4 py-2 fw-semibold shadow-sm">Jelajahi</a>
                        <a href="#tentang" class="btn btn-outline-light px-4 py-2 fw-semibold">Tentang Kami</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FLOATING STATS CARD -->
    <div class="container stats-wrapper">
        <div class="bg-white rounded-3 shadow-sm border p-4">
            <div class="row g-4 text-center text-md-start">
                <div class="col-6 col-md-3 d-flex align-items-center justify-content-center justify-content-md-start gap-3">
                    <div class="text-primary fs-2"><i class="fa-solid fa-users"></i></div>
                    <div>
                        <h4 class="fw-bold mb-0 text-dark">1000+</h4>
                        <p class="text-muted small mb-0 fw-medium">Siswa</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 d-flex align-items-center justify-content-center justify-content-md-start gap-3">
                    <div class="text-primary fs-2"><i class="fa-solid fa-user-check"></i></div>
                    <div>
                        <h4 class="fw-bold mb-0 text-dark">50+</h4>
                        <p class="text-muted small mb-0 fw-medium">Guru</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 d-flex align-items-center justify-content-center justify-content-md-start gap-3">
                    <div class="text-primary fs-2"><i class="fa-solid fa-tablet-screen-button"></i></div>
                    <div>
                        <h4 class="fw-bold mb-0 text-dark">4</h4>
                        <p class="text-muted small mb-0 fw-medium">Jurusan</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 d-flex align-items-center justify-content-center justify-content-md-start gap-3">
                    <div class="text-primary fs-2"><i class="fa-solid fa-ribbon"></i></div>
                    <div>
                        <h4 class="fw-bold mb-0 text-dark">10+</h4>
                        <p class="text-muted small mb-0 fw-medium">Ekstrakurikuler</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TENTANG KAMI -->
    <section id="tentang" class="py-5 mt-4">
        <div class="container pb-4">
            <div class="mb-5">
                <h2 class="fw-bold text-dark text-uppercase letter-spacing-1 mb-1">Tentang Kami</h2>
                <p class="text-muted mb-2">Mengenal lebih dekat SMKN 4 Kota Bogor</p>
                <div class="bg-primary rounded" style="width: 50px; height: 4px;"></div>
            </div>

            <div class="row g-4 mb-5">
                <!-- Left: Foto Lapangan -->
                <div class="col-lg-5">
                    <img src="{{ asset('storage/sekolah tentang.jpg') }}"
                         alt="Lapangan SMKN 4 Bogor"
                         class="img-fluid rounded shadow-sm w-100 h-100 object-fit-cover">
                </div>

                <!-- Middle: Deskripsi Profil -->
                <div class="col-lg-4 d-flex flex-column justify-content-center">
                    <span class="text-primary fw-bold text-uppercase small mb-2">Profil Sekolah</span>
                    <h3 class="fw-bold text-dark mb-3">SMKN 4 Kota Bogor</h3>
                    <p class="text-secondary small lh-lg">
                        SMK Negeri 4 Kota Bogor merupakan sekolah menengah kejuruan berbasis teknologi dan industri di Kota Bogor. Didirikan untuk menjawab tantangan dunia kerja dan industri modern melalui pendidikan vokasi berkualitas.
                    </p>
                    <p class="text-secondary small lh-lg mb-0">
                        Dengan kurikulum yang selalu diselaraskan dengan kebutuhan Industri, Dunia Usaha, dan Dunia Kerja (IDUKA), kami berkomitmen mencetak lulusan yang cerdas, kompeten, dan berkarakter unggul.
                    </p>
                </div>

                <!-- Right: Ringkasan Info -->
                <div class="col-lg-3">
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex align-items-center gap-3 p-3 bg-white border rounded shadow-sm">
                            <i class="fa-regular fa-calendar text-primary fs-5"></i>
                            <div>
                                <span class="d-block fw-bold small text-dark">Tahun Berdiri</span>
                                <span class="small text-muted">2009</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3 p-3 bg-white border rounded shadow-sm">
                            <i class="fa-regular fa-square-check text-primary fs-5"></i>
                            <div>
                                <span class="d-block fw-bold small text-dark">Status</span>
                                <span class="small text-muted">Negeri</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3 p-3 bg-white border rounded shadow-sm">
                            <i class="fa-solid fa-ribbon text-primary fs-5"></i>
                            <div>
                                <span class="d-block fw-bold small text-dark">Akreditasi</span>
                                <span class="small text-muted">A (Unggul)</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3 p-3 bg-white border rounded shadow-sm">
                            <i class="fa-solid fa-location-dot text-primary fs-5"></i>
                            <div>
                                <span class="d-block fw-bold small text-dark">Alamat</span>
                                <span class="small text-muted">Jalan Raya Tajur, Muarasari</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- VISI & MISI -->
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100 p-4 rounded-4">
                        <div class="d-flex align-items-start gap-3">
                            <div class="icon-box-lg bg-primary text-white fs-4">
                                <i class="fa-solid fa-bullseye"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark text-uppercase mb-2">Visi</h5>
                                <p class="text-secondary small lh-lg mb-0">
                                    Menjadi SMK yang unggul, kompeten, kreatif, dan berkarakter.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100 p-4 rounded-4">
                        <div class="d-flex align-items-start gap-3">
                            <div class="icon-box-lg bg-primary text-white fs-4">
                                <i class="fa-solid fa-flag"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark text-uppercase mb-2">Misi</h5>
                                <ul class="text-secondary small lh-lg mb-0 ps-3">
                                    <li>Meningkatkan kompetensi dan prestasi siswa.</li>
                                    <li>Mengembangkan karakter disiplin dan bertanggung jawab.</li>
                                    <li>Mempersiapkan lulusan sesuai kebutuhan dunia kerja.</li>
                                    <li>Mendorong kreativitas dan inovasi siswa.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PROGRAM KEAHLIAN -->
    <section id="program" class="py-5 bg-white border-top border-bottom">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-dark text-uppercase mb-1">Program Keahlian</h2>
                <div class="bg-primary mx-auto rounded" style="width: 50px; height: 4px;"></div>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
                <!-- PPLG -->
                <div class="col">
                    <div class="card h-100 border bg-light text-center p-4 rounded-4 shadow-sm">
                        <div class="bg-blue-soft rounded d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 3.5rem; height: 3.5rem; font-size: 1.5rem;">
                            <i class="fa-solid fa-desktop"></i>
                        </div>
                        <h5 class="fw-bold text-dark small mb-2">PPLG</h5>
                        <p class="text-muted small mb-0" style="font-size: 0.8rem;">Pengembangan Perangkat Lunak dan Gim</p>
                    </div>
                </div>

                <!-- TJKT -->
                <div class="col">
                    <div class="card h-100 border bg-light text-center p-4 rounded-4 shadow-sm">
                        <div class="bg-blue-soft rounded d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 3.5rem; height: 3.5rem; font-size: 1.5rem;">
                            <i class="fa-solid fa-wifi"></i>
                        </div>
                        <h5 class="fw-bold text-dark small mb-2">TJKT</h5>
                        <p class="text-muted small mb-0" style="font-size: 0.8rem;">Teknik Jaringan Komputer dan Telekomunikasi</p>
                    </div>
                </div>

                <!-- TPFL -->
                <div class="col">
                    <div class="card h-100 border bg-light text-center p-4 rounded-4 shadow-sm">
                        <div class="bg-amber-soft rounded d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 3.5rem; height: 3.5rem; font-size: 1.5rem;">
                            <i class="fa-solid fa-key"></i>
                        </div>
                        <h5 class="fw-bold text-dark small mb-2">TPFL</h5>
                        <p class="text-muted small mb-0" style="font-size: 0.8rem;">Teknik Pengelasan dan Fabrikasi Logam</p>
                    </div>
                </div>

                <!-- TO -->
                <div class="col">
                    <div class="card h-100 border bg-light text-center p-4 rounded-4 shadow-sm">
                        <div class="bg-slate-soft rounded d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 3.5rem; height: 3.5rem; font-size: 1.5rem;">
                            <i class="fa-solid fa-gear"></i>
                        </div>
                        <h5 class="fw-bold text-dark small mb-2">TO</h5>
                        <p class="text-muted small mb-0" style="font-size: 0.8rem;">Teknik Otomotif</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FASILITAS SEKOLAH -->
    <section class="py-5">
        <div class="container">
            <div class="mb-5">
                <h2 class="fw-bold text-dark text-uppercase mb-1">Fasilitas Sekolah</h2>
                <div class="bg-primary rounded" style="width: 50px; height: 4px;"></div>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3">
                <div class="col">
                    <div class="fasilitas-card bg-white border rounded shadow-sm p-3 d-flex align-items-center gap-3">
                        <div class="bg-primary bg-opacity-10 text-primary rounded p-3 d-flex align-items-center justify-content-center fs-5">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1 text-dark small">UKS</h6>
                            <p class="text-muted mb-0" style="font-size: 0.75rem;">Fasilitas kesehatan sekolah dengan ruang medis lengkap</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="fasilitas-card bg-white border rounded shadow-sm p-3 d-flex align-items-center gap-3">
                        <div class="bg-primary bg-opacity-10 text-primary rounded p-3 d-flex align-items-center justify-content-center fs-5">
                            <i class="fa-regular fa-bookmark"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1 text-dark small">Perpustakaan</h6>
                            <p class="text-muted mb-0" style="font-size: 0.75rem;">Koleksi buku, referensi, dan modul pembelajaran</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="fasilitas-card bg-white border rounded shadow-sm p-3 d-flex align-items-center gap-3">
                        <div class="bg-primary bg-opacity-10 text-primary rounded p-3 d-flex align-items-center justify-content-center fs-5">
                            <i class="fa-solid fa-desktop"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1 text-dark small">Lab Komputer</h6>
                            <p class="text-muted mb-0" style="font-size: 0.75rem;">Perangkat komputer modern untuk praktikum</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="fasilitas-card bg-white border rounded shadow-sm p-3 d-flex align-items-center gap-3">
                        <div class="bg-primary bg-opacity-10 text-primary rounded p-3 d-flex align-items-center justify-content-center fs-5">
                            <i class="fa-solid fa-gear"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1 text-dark small">Bengkel Praktik</h6>
                            <p class="text-muted mb-0" style="font-size: 0.75rem;">Peralatan praktik sesuai standar industri</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="fasilitas-card bg-white border rounded shadow-sm p-3 d-flex align-items-center gap-3">
                        <div class="bg-primary bg-opacity-10 text-primary rounded p-3 d-flex align-items-center justify-content-center fs-5">
                            <i class="fa-solid fa-basketball"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1 text-dark small">Lapangan</h6>
                            <p class="text-muted mb-0" style="font-size: 0.75rem;">Lapangan serbaguna untuk olahraga & upacara</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="fasilitas-card bg-white border rounded shadow-sm p-3 d-flex align-items-center gap-3">
                        <div class="bg-primary bg-opacity-10 text-primary rounded p-3 d-flex align-items-center justify-content-center fs-5">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1 text-dark small">Aula</h6>
                            <p class="text-muted mb-0" style="font-size: 0.75rem;">Ruang serbaguna untuk kegiatan dan acara sekolah</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="fasilitas-card bg-white border rounded shadow-sm p-3 d-flex align-items-center gap-3">
                        <div class="bg-primary bg-opacity-10 text-primary rounded p-3 d-flex align-items-center justify-content-center fs-5">
                            <i class="fa-solid fa-mosque"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1 text-dark small">Mushola</h6>
                            <p class="text-muted mb-0" style="font-size: 0.75rem;">Tempat ibadah yang bersih dan nyaman</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="fasilitas-card bg-white border rounded shadow-sm p-3 d-flex align-items-center gap-3">
                        <div class="bg-primary bg-opacity-10 text-primary rounded p-3 d-flex align-items-center justify-content-center fs-5">
                            <i class="fa-solid fa-wifi"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1 text-dark small">Wifi Area</h6>
                            <p class="text-muted mb-0" style="font-size: 0.75rem;">Akses internet cepat di seluruh area sekolah</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- INFORMASI KONTAK SEKOLAH -->
    <section id="kontak" class="py-5 bg-white border-top">
        <div class="container">
            <div class="mb-5">
                <h2 class="fw-bold text-dark text-uppercase mb-1">Informasi Kontak Sekolah</h2>
                <p class="text-muted">Saran dan Kritik sangat kami terima untuk perkembangan dan pengembangan sekolah kami.</p>
                <div class="bg-primary rounded" style="width: 50px; height: 4px;"></div>
            </div>

            <div class="row g-4">

                <!-- Left Side: 5 Pill Contacts -->
                <div class="col-lg-7 d-flex flex-column gap-3">

                    <!-- Telepon (tidak bisa diklik) -->
                    <div class="d-flex align-items-center gap-3 p-3 border rounded shadow-sm bg-white">
                        <i class="fa-solid fa-phone text-secondary"></i>
                        <span class="fw-semibold text-dark small">+62 821 226 2442</span>
                    </div>

                    <!-- Email (tidak bisa diklik) -->
                    <div class="d-flex align-items-center gap-3 p-3 border rounded shadow-sm bg-white">
                        <i class="fa-regular fa-envelope text-secondary"></i>
                        <span class="fw-semibold text-dark small">smkn4@smkn4-bogor.sch.id</span>
                    </div>

                    <a href="https://instagram.com/smkn4kotabogor" target="_blank" rel="noopener noreferrer" class="d-flex align-items-center gap-3 p-3 border rounded shadow-sm bg-white text-decoration-none">
                        <i class="fa-brands fa-instagram text-secondary"></i>
                        <span class="fw-semibold text-dark small">@smkn4kotabogor</span>
                    </a>

                    <a href="https://youtube.com/@smknegeri4bogor905" target="_blank" rel="noopener noreferrer" class="d-flex align-items-center gap-3 p-3 border rounded shadow-sm bg-white text-decoration-none">
                        <i class="fa-brands fa-youtube text-secondary"></i>
                        <span class="fw-semibold text-dark small">@smknegeri4bogor905</span>
                    </a>

                    <a href="https://facebook.com/SMKNEGERI4KOTABOGOR" target="_blank" rel="noopener noreferrer" class="d-flex align-items-center gap-3 p-3 border rounded shadow-sm bg-white text-decoration-none">
                        <i class="fa-brands fa-facebook-f text-secondary"></i>
                        <span class="fw-semibold text-dark small">SMK NEGERI 4 KOTA BOGOR</span>
                    </a>

                </div>

                <!-- Right Side: Location Card -->
                <div class="col-lg-5">
                    <div class="card border shadow-sm p-3 rounded-4 h-100 d-flex flex-column">

                        <!-- Peta tertanam: pencarian alamat sekolah -->
                        <div class="rounded overflow-hidden mb-3 border" style="height: 200px;">
                            <iframe
                                src="https://maps.google.com/maps?q=SMK+Negeri+4+Kota+Bogor+Jalan+Raya+Tajur+Muarasari+Bogor+Selatan&hl=id&z=16&output=embed"
                                width="100%"
                                height="100%"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                title="Peta lokasi SMKN 4 Kota Bogor">
                            </iframe>
                        </div>

                        <h6 class="fw-bold text-dark text-uppercase mb-2">SMKN 4 KOTA BOGOR</h6>

                        <div class="d-flex align-items-start gap-2 p-3 rounded mb-3 border border-primary-subtle" style="background-color: #eff6ff;">
                            <i class="fa-solid fa-location-dot mt-1 text-primary"></i>
                            <p class="mb-0 small fw-medium" style="color: #1e3a8a;">
                                Jl. Raya Tajur, Kp. Buntar RT.02/RW.08, Kel. Muarasari, Kec. Bogor Selatan, Kota Bogor, Jawa Barat 16137
                            </p>
                        </div>

                        <!-- Link Google Maps -->
                        <a href="https://maps.app.goo.gl/xWggQbg8P8LviTuZ8" target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary w-100 fw-bold mt-auto d-flex align-items-center justify-content-center gap-2">
                            <i class="fa-solid fa-location-arrow"></i> Lihat di Google Maps
                        </a>
                    </div>
                </div>

            </div> <!-- End Row Grid -->

            <!-- FORM KOTAK PESAN -->
            <div class="row mt-5">
                <div class="col-lg-8 mx-auto">
                    <div class="card border shadow-sm rounded-4 p-4">
                        <h5 class="fw-bold text-dark mb-1">Kirim Pesan</h5>
                        <p class="text-muted small mb-4">Sampaikan saran, kritik, atau pertanyaan Anda kepada kami.</p>

                        @if (session('success'))
                            <div class="alert alert-success rounded-3">{{ session('success') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger rounded-3">
                                <ul class="mb-0 small">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('pesan.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nama" class="form-label small fw-semibold">Nama</label>
                                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                                           class="form-control @error('nama') is-invalid @enderror" placeholder="Nama lengkap" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label small fw-semibold">Email</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                           class="form-control @error('email') is-invalid @enderror" placeholder="nama@email.com" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-semibold d-block">Rating</label>
                                    <div class="star-rating">
                                        @for ($i = 5; $i >= 1; $i--)
                                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}"
                                                   {{ old('rating') == $i ? 'checked' : '' }}>
                                            <label for="star{{ $i }}" title="{{ $i }} bintang">
                                                <i class="fa-solid fa-star"></i>
                                            </label>
                                        @endfor
                                    </div>
                                    @error('rating')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="isi_pesan" class="form-label small fw-semibold">Pesan</label>
                                    <textarea id="isi_pesan" name="isi_pesan" rows="5"
                                              class="form-control @error('isi_pesan') is-invalid @enderror"
                                              placeholder="Tulis pesan Anda di sini..." required>{{ old('isi_pesan') }}</textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-4 fw-semibold">
                                        <i class="fa-solid fa-paper-plane me-2"></i>Kirim Pesan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Memanggil Footer dari partials -->
    @include('partials.footer')

    <!-- Bootstrap 5 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>