@extends('admin.layouts.app')

@section('title', 'Edit Produk - SMKN 4 Kota Bogor')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    /* Styling Tambahan Badge Status */
    .badge-publik-custom {
        background-color: #dcfce7;
        color: #166534;
        font-weight: 500;
        font-size: 0.75rem;
        padding: 4px 10px;
        border-radius: 50rem;
    }
    .badge-draft-custom {
        background-color: #fef3c7;
        color: #92400e;
        font-weight: 500;
        font-size: 0.75rem;
        padding: 4px 10px;
        border-radius: 50rem;
    }
</style>
@endpush

@section('content')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div class="container-fluid py-3 px-0" x-data="{ 
    previewImage: '{{ asset($produk->gambar) }}',
    namaFile: 'Gambar saat ini',
    handleFileUpload(event) {
        const file = event.target.files[0];
        if (file) {
            this.namaFile = file.name;
            const reader = new FileReader();
            reader.onload = (e) => { this.previewImage = e.target.result; };
            reader.readAsDataURL(file);
        }
    }
}">

    <!-- HEADER TITLE & PROFILE -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: #0f172a;">Admin</h2>
        </div>
        <div class="d-flex align-items-center gap-2">
            <div class="bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="text-start">
                <span class="d-block fw-bold text-dark" style="font-size: 0.9rem; line-height: 1.2;">Admin</span>
                <span class="text-muted" style="font-size: 0.75rem;">Administrator</span>
            </div>
        </div>
    </div>

    <!-- MAIN CARD FORM -->
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">

        <!-- CARD HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-1">
            <h3 class="fw-bold mb-0 text-dark" style="font-size: 1.5rem;">Edit Produk</h3>
            <a href="{{ route('admin.produk.index') }}" class="btn rounded-3 px-3 py-2 d-inline-flex align-items-center gap-2" style="border: 1px solid #cbd5e1; color: #1e293b; font-weight: 500; font-size: 0.85rem;">
                <i class="fa-solid fa-arrow-left text-primary"></i> Kembali ke produk
            </a>
        </div>
        
        <p class="text-muted mb-4 pb-2" style="font-size: 0.9rem;">Perbarui data produk/karya siswa yang ada di website.</p>

        @if ($errors->any())
            <div class="alert alert-danger rounded-3 mb-4">
                <strong>Gagal memperbarui data!</strong>
                <ul class="mb-0 mt-1 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <!-- KOLOM KIRI (1. Upload Foto & 4. Tanggal Rilis/Pembuatan) -->
                <div class="col-lg-6 d-flex flex-column justify-content-between">
                    <!-- 1. Upload Foto Produk -->
                    <div class="mb-3">
                        <label class="fw-bold mb-2 d-block text-dark">1. Upload Foto Produk</label>

                        <!-- Input File Sembunyi -->
                        <input type="file" 
                               id="inputGambarProduk" 
                               name="gambar" 
                               style="display: none;" 
                               @change="handleFileUpload($event)" 
                               accept="image/png, image/jpeg, image/jpg, image/webp">

                        <!-- DROPZONE CONTAINER -->
                        <label for="inputGambarProduk" 
                               style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; width: 100%; height: 210px; min-height: 210px; max-height: 210px; border: 2px dashed #93c5fd; border-radius: 12px; background-color: #ffffff; cursor: pointer; overflow: hidden; box-sizing: border-box; margin: 0; padding: 15px;">
                            
                            <!-- State 1: Sebelum Upload (Jika tidak ada gambar sama sekali) -->
                            <template x-if="!previewImage">
                                <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; width: 100%; height: 100%; margin: auto;">
                                    <div style="margin-bottom: 8px;">
                                        <i class="fa-solid fa-cloud-arrow-up" style="font-size: 2.5rem; color: #2563eb;"></i>
                                    </div>
                                    <p style="font-weight: 600; color: #1d4ed8; font-size: 0.9rem; margin: 0 0 4px 0; text-align: center;">
                                        Klik atau drag file ke sini untuk upload
                                    </p>
                                    <p style="color: #64748b; font-size: 0.78rem; margin: 0; text-align: center;">
                                        Format: JPG, PNG, JPEG, WEBP (Max. 10 MB)
                                    </p>
                                </div>
                            </template>

                            <!-- State 2: Preview Gambar Terpasang / Diubah -->
                            <template x-if="previewImage">
                                <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; width: 100%; height: 100%; margin: auto;">
                                    <img :src="previewImage" 
                                         alt="Preview Gambar Produk" 
                                         style="max-width: 100%; max-height: 110px; width: auto; height: auto; object-fit: contain; border-radius: 8px; display: block; margin: 0 auto 8px auto;">
                                    <p style="font-weight: 600; color: #1e293b; font-size: 0.85rem; margin: 0; text-align: center; max-width: 90%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" 
                                       x-text="namaFile"></p>
                                    <p style="color: #2563eb; font-size: 0.75rem; margin: 4px 0 0 0; text-align: center;">
                                        Klik untuk mengganti foto produk
                                    </p>
                                </div>
                            </template>
                        </label>

                        <p class="text-muted small mt-2 mb-0" style="font-size: 0.8rem;">*Biarkan kosong jika tidak ingin mengubah foto produk</p>
                    </div>

                    <!-- 4. Tanggal -->
                    <div class="mb-3">
                        <label class="fw-bold mb-2 text-dark">4. Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', $produk->tanggal) }}" class="form-control rounded-3 py-2" required>
                        <span class="text-muted d-block mt-1" style="font-size: 0.8rem;">Tanggal publikasi atau pembuatan karya</span>
                    </div>
                </div>

                <!-- KOLOM KANAN (2. Judul, 3. Kategori/Jurusan, 5. Status) -->
                <div class="col-lg-6">
                    <!-- 2. Judul Produk -->
                    <div class="mb-4">
                        <label class="fw-bold mb-2 text-dark">2. Judul Produk</label>
                        <input type="text" name="judul" value="{{ old('judul', $produk->judul) }}" class="form-control rounded-3 py-2" placeholder="Masukkan judul/nama produk" required>
                        <span class="text-muted d-block mt-1" style="font-size: 0.8rem;">Contoh: Aplikasi Website E-Commerce PPLG</span>
                    </div>

                    <!-- 3. Kategori / Jurusan -->
                    <div class="mb-4">
                        <label class="fw-bold mb-2 text-dark">3. Kategori (Jurusan)</label>
                        <select name="kategori" class="form-select rounded-3 py-2 text-uppercase" required>
                            <option value="" disabled>Pilih jurusan</option>
                            <option value="pplg" {{ old('kategori', strtolower($produk->kategori)) == 'pplg' ? 'selected' : '' }}>PPLG</option>
                            <option value="tjkt" {{ old('kategori', strtolower($produk->kategori)) == 'tjkt' ? 'selected' : '' }}>TJKT</option>
                            <option value="tpfl" {{ old('kategori', strtolower($produk->kategori)) == 'tpfl' ? 'selected' : '' }}>TPFL</option>
                            <option value="to" {{ old('kategori', strtolower($produk->kategori)) == 'to' ? 'selected' : '' }}>TO</option>
                        </select>
                        <span class="text-muted d-block mt-1" style="font-size: 0.8rem;">Pilih jurusan pembuat produk</span>
                    </div>

                    <!-- 5. Status -->
                    <div class="mb-4">
                        <label class="fw-bold mb-2 text-dark">5. Status</label>
                        <div class="d-flex flex-column gap-2 mb-1">
                            <div class="form-check d-flex align-items-center gap-2">
                                <input class="form-check-input mt-0" type="radio" name="status" value="publik" id="statusPublik" {{ old('status', $produk->status) == 'publik' ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold text-dark" for="statusPublik" style="font-size: 0.9rem;">Publik</label>
                                <span class="badge badge-publik-custom">Akan ditampilkan di website</span>
                            </div>
                            <div class="form-check d-flex align-items-center gap-2">
                                <input class="form-check-input mt-0" type="radio" name="status" value="draft" id="statusDraft" {{ old('status', $produk->status) == 'draft' ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold text-dark" for="statusDraft" style="font-size: 0.9rem;">Draft</label>
                                <span class="badge badge-draft-custom">Disimpan sebagai draft</span>
                            </div>
                        </div>
                        <span class="text-muted d-block" style="font-size: 0.8rem;">Pilih status visibilitas produk</span>
                    </div>
                </div>
            </div>

            <!-- TOMBOL AKSI -->
            <div class="d-flex justify-content-end gap-2 pt-3 mt-3 border-top">
                <a href="{{ route('admin.produk.index') }}" class="btn rounded-3 px-4 py-2" style="border: 1px solid #cbd5e1; color: #024eec; font-weight: 500;">Batal</a>
                <button type="submit" class="btn btn-primary rounded-3 px-4 py-2 fw-semibold" style="background-color: #0d6efd; border: none;">Perbarui data</button>
            </div>
        </form>

    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush