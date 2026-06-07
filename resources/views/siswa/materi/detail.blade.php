@extends('layouts.app')
@section('title', $materi->title)
@section('content')

<div class="container-fluid py-3">
    <!-- SUBHEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-slate-800 mb-1">Materi Belajar</h3>
            <p class="text-secondary mb-0">Mulai belajar dengan berkas materi di bawah</p>
        </div>
        <a href="{{ route('materi.index') }}" class="btn btn-outline-secondary px-3 py-2 rounded-3 d-inline-flex align-items-center gap-1.5 fw-medium">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row g-4">
        <!-- MAIN CONTENT -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm overflow-hidden mb-4">
                <div class="card-header bg-white py-3 px-4">
                    <h5 class="fw-semibold text-slate-800 mb-0">Konten Pembelajaran</h5>
                </div>
                <div class="card-body p-4 bg-light-subtle">
                    <!-- CONTENT RENDER -->
                    <x-materi-renderer :materi="$materi" />
                </div>
            </div>
        </div>

        <!-- SIDEBAR -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-semibold text-slate-800 mb-3">Detail Materi</h5>

                    <div class="mb-4">
                        <label class="text-secondary small fw-semibold text-uppercase tracking-wider">Judul</label>
                        <h6 class="fw-bold text-dark mt-1" style="font-size: 1.1rem;">{{ $materi->title }}</h6>
                    </div>

                    <div class="mb-4">
                        <label class="text-secondary small fw-semibold text-uppercase tracking-wider">Deskripsi</label>
                        <p class="text-secondary mt-1 mb-0" style="font-size: 0.95rem; line-height: 1.6;">
                            {{ $materi->description ?? 'Tidak ada deskripsi.' }}
                        </p>
                    </div>

                    <hr class="my-4" style="border-color: rgba(226, 232, 240, 0.8);">

                    <div class="mb-3 d-flex align-items-center justify-content-between p-2.5 bg-light rounded-3 border" style="border-color: rgba(226, 232, 240, 0.8) !important;">
                        <span class="text-secondary small fw-medium">Tipe Materi</span>
                        @if($materi->type == 'pdf')
                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1.5 rounded-pill fw-medium">
                                <i class="bi bi-file-earmark-pdf me-1"></i>PDF
                            </span>
                        @elseif($materi->type == 'image')
                            <span class="badge bg-info-subtle text-info border border-info-subtle px-2.5 py-1.5 rounded-pill fw-medium">
                                <i class="bi bi-image me-1"></i>IMAGE
                            </span>
                        @else
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2.5 py-1.5 rounded-pill fw-medium">
                                <i class="bi bi-youtube me-1"></i>YOUTUBE
                            </span>
                        @endif
                    </div>

                    <div class="d-flex align-items-center justify-content-between p-2.5 bg-light rounded-3 border" style="border-color: rgba(226, 232, 240, 0.8) !important;">
                        <span class="text-secondary small fw-medium">Tanggal Rilis</span>
                        <span class="text-dark small fw-semibold">
                            <i class="bi bi-calendar3 text-secondary me-1.5"></i>{{ $materi->created_at->format('d M Y') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
