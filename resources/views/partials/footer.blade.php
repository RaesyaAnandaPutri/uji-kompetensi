<!-- Bootstrap 5 CSS CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<footer class="text-white pt-5 pb-3 border-top" style="background-color: #0B1E59; border-color: #1e3a8a !important;">
    <div class="container">
        <div class="row g-4 mb-4">
            
            <!-- Kolom 1: Brand & Deskripsi -->
            <div class="col-lg-5 col-md-6">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <img src="{{ asset('storage/logo smkn 4.png') }}" alt="Logo SMKN 4 Bogor" width="36" height="36" class="bg-white rounded p-1 object-fit-contain">
                    <span class="fw-bold small text-uppercase lh-sm" style="font-size: 0.8rem; letter-spacing: 0.025em;">
                        SEKOLAH MENENGAH KEJURUAN NEGERI 4 KOTA BOGOR
                    </span>
                </div>
                <p class="small mb-0 pe-lg-4" style="color: #d1d5db; line-height: 1.6;">
                    Sekolah Pusat Keunggulan yang mencetak generasi unggul, kreatif, mandiri dan berkarakter.
                </p>
            </div>

            <!-- Kolom 2: Informasi Sekolah -->
            <div class="col-lg-3 col-md-6">
                <h6 class="fw-bold text-uppercase pb-2 border-bottom d-inline-block mb-3" style="font-size: 0.85rem; border-color: #1e3a8a !important; letter-spacing: 0.05em;">
                    INFORMASI SEKOLAH
                </h6>
                <ul class="list-unstyled small mb-0 d-flex flex-column gap-2" style="color: #d1d5db;">
                    <li>&bull; 4 Program Keahlian</li>
                    <li>&bull; 50+ Tenaga Pendidik</li>
                    <li>&bull; 1000+ Siswa</li>
                    <li>&bull; 10+ Ekstrakurikuler</li>
                </ul>
            </div>

            <!-- Kolom 3: Jam Operasional -->
            <div class="col-lg-4 col-md-6">
                <h6 class="fw-bold text-uppercase pb-2 border-bottom d-inline-block mb-3" style="font-size: 0.85rem; border-color: #1e3a8a !important; letter-spacing: 0.05em;">
                    JAM OPERASIONAL
                </h6>
                <div class="small d-flex flex-column gap-3" style="color: #d1d5db;">
                    <div>
                        <strong class="d-block text-white fw-semibold">Senin - Jumat</strong>
                        <span>07.00 - 16.00</span>
                    </div>
                    <div>
                        <strong class="d-block text-white fw-semibold">Sabtu</strong>
                        <span>07.00 - 12.00</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Footer Bottom / Copyright -->
        <div class="text-center border-top pt-3 mt-4" style="font-size: 0.75rem; color: #9ca3af; border-color: rgba(30, 58, 138, 0.5) !important;">
            &copy; {{ date('Y') }} SMKN 4 Kota Bogor. All rights reserved.
        </div>
    </div>
</footer>