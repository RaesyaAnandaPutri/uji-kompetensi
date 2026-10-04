@extends('admin.layouts.app')

@section('title', 'Manajemen Pesan - SMKN 4 Kota Bogor')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@section('content')
<div class="container-fluid py-3 px-0">

    <!-- HEADER -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h2 class="fw-bold mb-1" style="color: #0f172a;">Manajemen Pesan</h2>
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
        <div class="alert alert-success rounded-3 mb-4">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">

        <p class="text-muted small mb-3">Pesan yang dikirim pengunjung dari halaman beranda website</p>

        <!-- RINGKASAN RATING -->
        @if ($totalRating > 0)
            <div class="d-flex align-items-center gap-2 mb-4 p-3 rounded-3 bg-warning-subtle border border-warning-subtle" style="max-width: 360px;">
                <i class="fa-solid fa-star text-warning fs-4"></i>
                <div>
                    <span class="fw-bold text-dark fs-5">{{ number_format($rataRating, 1) }}</span>
                    <span class="text-muted small">/ 5 dari {{ $totalRating }} rating</span>
                </div>
            </div>
        @endif

        <!-- FILTER STATUS -->
        @php $currentStatus = request('status', 'semua'); @endphp
        <div class="d-flex flex-wrap gap-2 mb-4">
            @foreach (['semua' => 'Semua', 'belum' => 'Belum Dibaca', 'dibaca' => 'Sudah Dibaca'] as $key => $label)
                <a href="{{ route('admin.pesan.index', array_merge(request()->except('page'), ['status' => $key])) }}"
                   class="btn btn-sm rounded-3 px-4 py-2 fw-semibold {{ $currentStatus == $key ? 'btn-primary shadow-sm' : 'btn-light border text-secondary' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <!-- PENCARIAN -->
        <form action="{{ route('admin.pesan.index') }}" method="GET" class="mb-4" style="max-width: 360px;">
            <input type="hidden" name="status" value="{{ $currentStatus }}">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-secondary pe-0">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control border-start-0 ps-2 rounded-end-3 shadow-none" placeholder="Cari nama atau email..">
            </div>
        </form>

        <!-- TABEL -->
        <div class="border rounded-4 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary border-bottom">
                        <tr class="text-body-secondary small text-uppercase">
                            <th class="ps-4 py-3 fw-semibold">Pengirim</th>
                            <th class="py-3 fw-semibold">Pesan</th>
                            <th class="py-3 fw-semibold">Rating</th>
                            <th class="py-3 fw-semibold">Tanggal</th>
                            <th class="py-3 fw-semibold">Status</th>
                            <th class="pe-4 py-3 fw-semibold text-center" style="width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse ($pesanList as $item)
                            <tr class="{{ $item->is_read ? '' : 'table-light' }}">
                                <td class="ps-4 py-3">
                                    <div class="{{ $item->is_read ? 'fw-semibold' : 'fw-bold' }} text-dark">{{ $item->nama }}</div>
                                    <div class="text-body-secondary" style="font-size: 0.775rem;">{{ $item->email }}</div>
                                </td>
                                <td class="py-3 text-body-secondary" style="max-width: 320px;">
                                    {{ \Illuminate\Support\Str::limit($item->isi_pesan, 70) }}
                                </td>
                                <td class="py-3 text-nowrap">
                                    @if ($item->rating)
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa-solid fa-star {{ $i <= $item->rating ? 'text-warning' : 'text-secondary-subtle' }}" style="font-size: 0.8rem;"></i>
                                        @endfor
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td class="py-3 text-body-secondary text-nowrap">
                                    {{ $item->created_at->translatedFormat('d M Y, H:i') }}
                                </td>
                                <td class="py-3">
                                    @if ($item->is_read)
                                        <span class="badge px-3 py-2 rounded-2 fw-semibold bg-secondary-subtle text-secondary border border-secondary-subtle">Dibaca</span>
                                    @else
                                        <span class="badge px-3 py-2 rounded-2 fw-semibold bg-danger-subtle text-danger border border-danger-subtle">Baru</span>
                                    @endif
                                </td>
                                <td class="pe-4 py-3 text-center">
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        <a href="{{ route('admin.pesan.show', $item->id) }}" class="btn btn-sm btn-light border text-primary rounded-2 px-2 py-1" title="Lihat">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.pesan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');" class="d-inline">
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
                                <td colspan="6" class="text-center py-4 text-muted">Belum ada pesan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $pesanList->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush