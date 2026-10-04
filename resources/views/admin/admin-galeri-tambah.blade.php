@extends('admin.layouts.app')

@section('title', 'Tambah Galeri - SMKN 4 Kota Bogor')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    /* Styling Tambahan */
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
    previewImage: null,
    namaFile: '',
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
            <h3 class="fw-bold mb-0 text-dark" style="font-size: 1.5rem;">Tambah Galeri</h3>
            <a href="{{ route('admin.galeri.index') }}" class="btn rounded-3 px-3 py-2 d-inline-flex align-items-center gap-2" style="border: 1px solid #cbd5e1; color: #1e293b; font-weight: 500; font-size: 0.85rem;">
                <i class="fa-solid fa-arrow-left text-primary"></i> Kembali ke galeri
            </a>
        </div>
        
        <p class="text-muted mb-4 pb-2" style="font-size: 0.9rem;">Tampilkan data galeri baru yang akan ditampilkan di website.</p>

        @if ($errors->any())
            <div class="alert alert-danger rounded-3 mb-4">
                <strong>Gagal menyimpan data!</strong>
                <ul class="mb-0 mt-1 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM STORE GALERI -->
        <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">
                <!-- KOLOM KIRI (1. Upload Foto & 4. Tanggal) -->
                <div class="col-lg-6 d-flex flex-column justify-content-between">
                    <!-- 1. Upload Foto -->
                    <div class="mb-3">
                        <label class="fw-bold mb-2 d-block text-dark">1. Upload Foto</label>

                        <!-- Input File Sembunyi -->
                        <input type="file" 
                               id="inputGambarGaleri" 
                               name="gambar" 
                               style="display: none !important;" 
                               @change="handleFileUpload($event)" 
                               accept="image/png, image/jpeg, image/jpg">

                        <!-- DROPZONE CONTAINER (TERKUNCI PRESISI DI TENGAH) -->
                        <label for="inputGambarGaleri" 
                               style="display: flex !important; flex-direction: column !important; align-items: center !important; justify-content: center !important; text-align: center !important; width: 100% !important; height: 210px !important; min-height: 210px !important; max-height: 210px !important; border: 2px dashed #93c5fd !important; border-radius: 12px !important; background-color: #ffffff !important; cursor: pointer !important; overflow: hidden !important; box-sizing: border-box !important; margin: 0 !important; padding: 15px !important;">
                            
                            <!-- State 1: Sebelum Upload -->
                            <template x-if="!previewImage">
                                <div style="display: flex !important; flex-direction: column !important; align-items: center !important; justify-content: center !important; text-align: center !important; width: 100% !important; height: 100% !important; margin: auto !important;">
                                    <div style="margin-bottom: 8px !important;">
                                        <i class="fa-solid fa-cloud-arrow-up" style="font-size: 2.5rem !important; color: #2563eb !important;"></i>
                                    </div>
                                    <p style="font-weight: 600 !important; color: #1d4ed8 !important; font-size: 0.9rem !important; margin: 0 0 4px 0 !important; text-align: center !important;">
                                        Klik atau drag file ke sini untuk upload
                                    </p>
                                    <p style="color: #64748b !important; font-size: 0.78rem !important; margin: 0 !important; text-align: center !important;">
                                        Format: JPG, PNG, JPEG (Max. 10 MB)
                                    </p>
                                </div>
                            </template>

                            <!-- State 2: Setelah Upload -->
                            <template x-if="previewImage">
                                <div style="display: flex !important; flex-direction: column !important; align-items: center !important; justify-content: center !important; text-align: center !important; width: 100% !important; height: 100% !important; margin: auto !important;">
                                    <img :src="previewImage" 
                                         alt="Preview Gambar" 
                                         style="max-width: 100% !important; max-height: 110px !important; width: auto !important; height: auto !important; object-fit: contain !important; border-radius: 8px !important; display: block !important; margin: 0 auto 8px auto !important;">
                                    <p style="font-weight: 600 !important; color: #1e293b !important; font-size: 0.85rem !important; margin: 0 !important; text-align: center !important; max-width: 90% !important; overflow: hidden !important; text-overflow: ellipsis !important; white-space: nowrap !important;" 
                                       x-text="namaFile"></p>
                                    <p style="color: #2563eb !important; font-size: 0.75rem !important; margin: 4px 0 0 0 !important; text-align: center !important;">
                                        Klik untuk mengganti foto
                                    </p>
                                </div>
                            </template>
                        </label>

                        <p class="text-danger small mt-2 mb-0" style="font-size: 0.8rem !important;">*Foto wajib diisi</p>
                    </div>

                    <!-- 4. Tanggal -->
                    <div class="mb-3">
                        <label class="fw-bold mb-2 text-dark">4. Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="form-control rounded-3 py-2">
                        <span class="text-muted d-block mt-1" style="font-size: 0.8rem;">Pilih tanggal kegiatan</span>
                    </div>
                </div>

                <!-- KOLOM KANAN (2. Judul, 3. Kategori, 5. Status) -->
                <div class="col-lg-6">
                    <!-- 2. Judul -->
                    <div class="mb-4">
                        <label class="fw-bold mb-2 text-dark">2. Judul</label>
                        <input type="text" name="judul" value="{{ old('judul') }}" class="form-control rounded-3 py-2" placeholder="Masukkan judul galeri">
                        <span class="text-muted d-block mt-1" style="font-size: 0.8rem;">Contoh: Upacara Bendera</span>
                    </div>

                    <!-- 3. Kategori -->
                    <div class="mb-4">
                        <label class="fw-bold mb-2 text-dark">3. Kategori</label>
                        <select name="kategori" class="form-select rounded-3 py-2">
                            <option value="" disabled {{ old('kategori') ? '' : 'selected' }}>Pilih kategori</option>
                            <option value="kegiatan" {{ old('kategori') == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                            <option value="acara" {{ old('kategori') == 'acara' ? 'selected' : '' }}>Acara</option>
                            <option value="ekstrakurikuler" {{ old('kategori') == 'ekstrakurikuler' ? 'selected' : '' }}>Ekstrakurikuler</option>
                        </select>
                        <span class="text-muted d-block mt-1" style="font-size: 0.8rem;">Pilih jenis kategori galeri</span>
                    </div>

                    <!-- 5. Status -->
                    <div class="mb-4">
                        <label class="fw-bold mb-2 text-dark">5. Status</label>
                        <div class="d-flex flex-column gap-2 mb-1">
                            <div class="form-check d-flex align-items-center gap-2">
                                <input class="form-check-input mt-0" type="radio" name="status" value="publik" id="statusPublik" {{ old('status', 'publik') == 'publik' ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold text-dark" for="statusPublik" style="font-size: 0.9rem;">Publik</label>
                                <span class="badge badge-publik-custom">Akan ditampilkan diwebsite</span>
                            </div>
                            <div class="form-check d-flex align-items-center gap-2">
                                <input class="form-check-input mt-0" type="radio" name="status" value="draft" id="statusDraft" {{ old('status') == 'draft' ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold text-dark" for="statusDraft" style="font-size: 0.9rem;">Draft</label>
                                <span class="badge badge-draft-custom">Disimpan sebagai draft</span>
                            </div>
                        </div>
                        <span class="text-muted d-block" style="font-size: 0.8rem;">Pilih status galeri</span>
                    </div>
                </div>
            </div>

            <!-- TOMBOL AKSI -->
            <div class="d-flex justify-content-end gap-2 pt-3 mt-3 border-top">
                <a href="{{ route('admin.galeri.index') }}" class="btn rounded-3 px-4 py-2" style="border: 1px solid #cbd5e1 !important; color: #024eec !important; font-weight: 500 !important;">Batal</a>
                <button type="submit" class="btn btn-primary rounded-3 px-4 py-2 fw-semibold" style="background-color: #0d6efd !important; border: none !important;">Simpan galeri</button>
            </div>
        </form>

    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush