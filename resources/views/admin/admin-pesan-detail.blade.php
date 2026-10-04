@extends('admin.layouts.app')

@section('title', 'Detail Pesan - SMKN 4 Kota Bogor')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@section('content')
<div class="container-fluid py-3 px-0">

    <div class="mb-4">
        <h2 class="fw-bold mb-1" style="color: #0f172a;">Detail Pesan</h2>
    </div>

    @if (session('success'))
        <div class="alert alert-success rounded-3 mb-4">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white" style="max-width: 800px;">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
            <div>
                <h5 class="fw-bold text-dark mb-1">{{ $pesan->nama }}</h5>
                <a href="mailto:{{ $pesan->email }}" class="text-decoration-none small">{{ $pesan->email }}</a>
            </div>
            <span class="text-muted small">
                <i class="fa-regular fa-calendar me-1"></i>{{ $pesan->created_at->translatedFormat('d F Y, H:i') }}
            </span>
        </div>

        <hr>

        <div class="mb-3">
            @if ($pesan->rating)
                @for ($i = 1; $i <= 5; $i++)
                    <i class="fa-solid fa-star fs-5 {{ $i <= $pesan->rating ? 'text-warning' : 'text-secondary-subtle' }}"></i>
                @endfor
                <span class="text-muted small ms-2">{{ $pesan->rating }} / 5</span>
            @else
                <span class="text-muted small">Tidak ada rating</span>
            @endif
        </div>

        <div class="text-dark mb-4" style="line-height: 1.8;">{!! nl2br(e($pesan->isi_pesan)) !!}</div>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('admin.pesan.index') }}" class="btn btn-light border rounded-3 px-3">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali
                </a>
                        <form action="{{ route('admin.pesan.toggle', $pesan->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-light border rounded-3 px-3">
                    @if ($pesan->is_read)
                        <i class="fa-regular fa-envelope me-1"></i> Tandai Belum Dibaca
                    @else
                        <i class="fa-regular fa-envelope-open me-1"></i> Tandai Sudah Dibaca
                    @endif
                </button>
            </form>
            <form action="{{ route('admin.pesan.destroy', $pesan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-light border text-danger rounded-3 px-3">
                    <i class="fa-regular fa-trash-can me-1"></i> Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush