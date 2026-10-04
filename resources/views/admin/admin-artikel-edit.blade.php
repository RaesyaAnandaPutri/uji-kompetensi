@extends('admin.layouts.app')

@section('title', 'Edit Artikel - SMKN 4 Kota Bogor')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
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
    previewImage: '{{ $artikel->gambar ? asset($artikel->gambar) : '' }}',
    namaFile: '{{ $artikel->gambar ? 'Gambar saat ini' : '' }}',
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
            <h3 class="fw-bold mb-0 text-dark" style="font-size: 1.5rem;">Edit Artikel</h3>
            <a href="{{ route('admin.artikel.index') }}" class="btn rounded-3 px-3 py-2 d-inline-flex align-items-center gap-2" style="border: 1px solid #cbd5e1; color: #1e293b; font-weight: 500; font-size: 0.85rem;">
                <i class="fa-solid fa-arrow-left text-primary"></i> Kembali ke artikel
            </a>
        </div>
        
        <p class="text-muted mb-4 pb-2" style="font-size: 0.9rem;">Perbarui data artikel yang ada di website.</p>

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

        <form action="{{ route('admin.artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <!-- KOLOM KIRI (1. Upload Foto, 4. Tanggal, 6. Status) -->
                <div class="col-lg-6 d-flex flex-column justify-content-between">
                    <div>
                        <!-- 1. Upload Foto -->
                        <div class="mb-3">
                            <label class="fw-bold mb-2 d-block text-dark">1. Upload Foto</label>

                            <input type="file" 
                                   id="inputGambarArtikel" 
                                   name="gambar" 
                                   style="display: none;" 
                                   @change="handleFileUpload($event)" 
                                   accept="image/png, image/jpeg, image/jpg, image/webp">

                            <label for="inputGambarArtikel" 
                                   style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; width: 100%; height: 210px; min-height: 210px; max-height: 210px; border: 2px dashed #93c5fd; border-radius: 12px; background-color: #ffffff; cursor: pointer; overflow: hidden; box-sizing: border-box; margin: 0; padding: 15px;">
                                
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

                                <template x-if="previewImage">
                                    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; width: 100%; height: 100%; margin: auto;">
                                        <img :src="previewImage" 
                                             alt="Preview Gambar" 
                                             style="max-width: 100%; max-height: 110px; width: auto; height: auto; object-fit: contain; border-radius: 8px; display: block; margin: 0 auto 8px auto;">
                                        <p style="font-weight: 600; color: #1e293b; font-size: 0.85rem; margin: 0; text-align: center; max-width: 90%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" 
                                           x-text="namaFile"></p>
                                        <p style="color: #2563eb; font-size: 0.75rem; margin: 4px 0 0 0; text-align: center;">
                                            Klik untuk mengganti foto
                                        </p>
                                    </div>
                                </template>
                            </label>

                            <p class="text-muted small mt-2 mb-0" style="font-size: 0.8rem;">*Biarkan kosong jika tidak ingin mengubah foto</p>
                        </div>

                        <!-- 4. Tanggal -->
                        <div class="mb-4">
                            <label class="fw-bold mb-2 text-dark">4. Tanggal</label>
                            <input type="date" name="tanggal" value="{{ old('tanggal', \Carbon\Carbon::parse($artikel->tanggal)->format('Y-m-d')) }}" class="form-control rounded-3 py-2" required>
                        </div>
                    </div>

                    <!-- 6. Status -->
                    <div class="mb-3">
                        <label class="fw-bold mb-2 text-dark">6. Status</label>
                        <div class="d-flex flex-column gap-2 mb-1">
                            <div class="form-check d-flex align-items-center gap-2">
                                <input class="form-check-input mt-0" type="radio" name="status" value="publik" id="statusPublik" {{ old('status', $artikel->status) == 'publik' ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold text-dark" for="statusPublik" style="font-size: 0.9rem;">Publik</label>
                                <span class="badge badge-publik-custom">Akan ditampilkan diwebsite</span>
                            </div>
                            <div class="form-check d-flex align-items-center gap-2">
                                <input class="form-check-input mt-0" type="radio" name="status" value="draft" id="statusDraft" {{ old('status', $artikel->status) == 'draft' ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold text-dark" for="statusDraft" style="font-size: 0.9rem;">Draft</label>
                                <span class="badge badge-draft-custom">Disimpan sebagai draft</span>
                            </div>
                        </div>
                        <span class="text-muted d-block" style="font-size: 0.8rem;">Pilih status artikel</span>
                    </div>
                </div>

                <!-- KOLOM KANAN (2. Judul, 3. Kategori, 5. Deskripsi) -->
                <div class="col-lg-6">
                    <!-- 2. Judul -->
                    <div class="mb-4">
                        <label class="fw-bold mb-2 text-dark">2. Judul</label>
                        <input type="text" name="judul" value="{{ old('judul', $artikel->judul) }}" class="form-control rounded-3 py-2" placeholder="Masukkan judul artikel" required>
                    </div>

                    <!-- 3. Kategori -->
                    <div class="mb-4">
                        <label class="fw-bold mb-2 text-dark">3. Kategori</label>
                        <select name="kategori" class="form-select rounded-3 py-2" required>
                            <option value="" disabled>Pilih kategori</option>
                            <option value="pengumuman" {{ old('kategori', strtolower($artikel->kategori)) == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                            <option value="kegiatan" {{ old('kategori', strtolower($artikel->kategori)) == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                            <option value="prestasi" {{ old('kategori', strtolower($artikel->kategori)) == 'prestasi' ? 'selected' : '' }}>Prestasi</option>
                            <option value="berita" {{ old('kategori', strtolower($artikel->kategori)) == 'berita' ? 'selected' : '' }}>Berita</option>
                            <option value="edukasi" {{ old('kategori', strtolower($artikel->kategori)) == 'edukasi' ? 'selected' : '' }}>Edukasi</option>
                        </select>
                    </div>

                    <!-- 5. Deskripsi (Opsional) -->
                    <div class="mb-3">
                        <label class="fw-bold mb-2 text-dark">5. Deskripsi (Opsional)</label>
                        <textarea name="deskripsi" class="form-control rounded-3 p-3" rows="4" placeholder="Masukkan deskripsi singkat tentang artikel ini..">{{ old('deskripsi', $artikel->deskripsi) }}</textarea>
                        <span class="text-muted d-block mt-1" style="font-size: 0.8rem;">Deskripsi akan ditampilkan di halaman artikel</span>
                    </div>
                </div>
            </div>

            <!-- TOMBOL AKSI -->
            <div class="d-flex justify-content-end gap-2 pt-3 mt-3 border-top">
                <a href="{{ route('admin.artikel.index') }}" class="btn rounded-3 px-4 py-2" style="border: 1px solid #cbd5e1; color: #024eec; font-weight: 500;">Batal</a>
                <button type="submit" class="btn btn-primary rounded-3 px-4 py-2 fw-semibold" style="background-color: #0d6efd; border: none;">Perbarui data</button>
            </div>
        </form>

    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush