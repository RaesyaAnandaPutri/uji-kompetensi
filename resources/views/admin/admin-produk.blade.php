@extends('admin.layouts.app')

@section('title', 'Manajemen Produk - SMKN 4 Kota Bogor')

@push('styles')
<!-- Bootstrap 5.3 CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- FontAwesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@section('content')
<div class="container-fluid py-3 px-0">

    <!-- 1. HEADER TITLE & ADMIN PROFILE -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: #0f172a;">Manajemen Produk</h2>
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

    @if (session('success'))
        <div class="alert alert-success rounded-3 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- 2. MAIN CARD KONTEN -->
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
        
        <!-- SUBTITLE & TOMBOL TAMBAH PRODUK -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
            <p class="text-muted small mb-0">Kelola semua data produk/karya siswa yang ditampilkan di website</p>
            <a href="{{ route('admin.produk.create') }}" class="btn btn-primary px-3 py-2 rounded-3 fw-semibold shadow-sm d-inline-flex align-items-center gap-2">
                <i class="fa-solid fa-circle-plus"></i> Tambah Produk
            </a>
        </div>

        <!-- FILTER JURUSAN TABS -->
        @php
            $currentKategori = strtolower($kategori ?? request('kategori', 'semua'));
        @endphp
        <div class="d-flex flex-wrap gap-2 mb-4">
            <a href="{{ route('admin.produk.index', ['kategori' => 'semua', 'search' => request('search')]) }}" 
            class="btn btn-sm rounded-3 px-4 py-2 fw-semibold {{ $currentKategori == 'semua' ? 'btn-primary shadow-sm' : 'btn-light border text-secondary' }}">
                Semua
            </a>
            <a href="{{ route('admin.produk.index', ['kategori' => 'pplg', 'search' => request('search')]) }}" 
            class="btn btn-sm rounded-3 px-4 py-2 fw-semibold {{ $currentKategori == 'pplg' ? 'btn-primary shadow-sm' : 'btn-light border text-secondary' }}">
                PPLG
            </a>
            <a href="{{ route('admin.produk.index', ['kategori' => 'tjkt', 'search' => request('search')]) }}" 
            class="btn btn-sm rounded-3 px-4 py-2 fw-semibold {{ $currentKategori == 'tjkt' ? 'btn-primary shadow-sm' : 'btn-light border text-secondary' }}">
                TJKT
            </a>
            <a href="{{ route('admin.produk.index', ['kategori' => 'tpfl', 'search' => request('search')]) }}" 
            class="btn btn-sm rounded-3 px-4 py-2 fw-semibold {{ $currentKategori == 'tpfl' ? 'btn-primary shadow-sm' : 'btn-light border text-secondary' }}">
                TPFL
            </a>
            <a href="{{ route('admin.produk.index', ['kategori' => 'to', 'search' => request('search')]) }}" 
            class="btn btn-sm rounded-3 px-4 py-2 fw-semibold {{ $currentKategori == 'to' ? 'btn-primary shadow-sm' : 'btn-light border text-secondary' }}">
                TO
            </a>
        </div>

        <!-- INPUT PENCARIAN -->
        <form action="{{ route('admin.produk.index') }}" method="GET" class="mb-4" style="max-width: 360px;">
            <input type="hidden" name="kategori" value="{{ $currentKategori }}">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-secondary pe-0">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control border-start-0 ps-2 rounded-end-3 shadow-none" placeholder="Cari judul produk..">
            </div>
        </form>

        <!-- TABEL PRODUK -->
        <div class="border rounded-4 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary border-bottom">
                        <tr class="text-body-secondary small text-uppercase">
                            <th class="ps-4 py-3 fw-semibold" style="width: 100px;">Foto</th>
                            <th class="py-3 fw-semibold">Judul</th>
                            <th class="py-3 fw-semibold">Jurusan</th>
                            <th class="py-3 fw-semibold">Tanggal</th>
                            <th class="py-3 fw-semibold">Status</th>
                            <th class="pe-4 py-3 fw-semibold text-center" style="width: 110px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse ($produkList as $item)
                            <tr>
                                <td class="ps-4 py-3">
                                    <img src="{{ asset($item->gambar) }}" alt="Foto Produk" class="rounded-3 shadow-sm" style="width: 80px; height: 52px; object-fit: cover;">
                                </td>
                                <td class="py-3">
                                    <div class="fw-bold text-dark fs-6 mb-1">{{ $item->judul ?? $item->nama_produk }}</div>
                                    <div class="text-body-secondary d-flex align-items-center gap-1" style="font-size: 0.775rem;">
                                        <i class="fa-regular fa-calendar"></i>
                                        <span>{{ \Carbon\Carbon::parse($item->tanggal ?? $item->created_at)->translatedFormat('d F Y') }}</span>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <span class="badge bg-primary-subtle text-primary fw-bold text-uppercase px-3 py-2 rounded-3">
                                        {{ $item->kategori ?? '-' }}
                                    </span>
                                </td>
                                <td class="py-3 text-body-secondary text-nowrap">
                                    {{ \Carbon\Carbon::parse($item->tanggal ?? $item->created_at)->translatedFormat('d M Y') }}
                                </td>
                                <td class="py-3">
                                    @if ($item->status == 'publik')
                                        <span class="badge px-3 py-2 rounded-2 fw-semibold bg-success-subtle text-success border border-success-subtle">Publik</span>
                                    @else
                                        <span class="badge px-3 py-2 rounded-2 fw-semibold bg-secondary-subtle text-secondary border border-secondary-subtle">Draft</span>
                                    @endif
                                </td>
                                <td class="pe-4 py-3 text-center">
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        <a href="{{ route('admin.produk.edit', $item->id) }}" class="btn btn-sm btn-light border text-primary rounded-2 px-2 py-1" title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form action="{{ route('admin.produk.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light border text-danger rounded-2 px-2 py-1" title="Hapus">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Belum ada data produk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
@endsection

@push('scripts')
<!-- Bootstrap 5 JS Bundle CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush