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
                    @if($materi->type === 'image')
                        <div class="text-center p-3 bg-light border rounded-3">
                            <img src="{{ asset('storage/' . $materi->file_path) }}"
                                 class="img-fluid rounded shadow-sm border"
                                 alt="materi"
                                 style="max-height: 550px; object-fit: contain;">
                        </div>
                    @elseif($materi->type === 'pdf')
                        <div class="bg-light border rounded-3 p-1 mb-3">
                            <iframe src="{{ asset('storage/' . $materi->file_path) }}#toolbar=0&navpanes=0&scrollbar=0"
                                width="100%"
                                height="600px"
                                style="border: none;"
                                class="rounded-3">
                            </iframe>
                        </div>
                        <div class="p-3 bg-light border rounded-3 d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-file-earmark-pdf fs-4 text-danger"></i>
                                <div class="text-start">
                                    <span class="d-block fw-semibold text-dark small">Dokumen PDF Pembelajaran</span>
                                    <span class="text-secondary small">Klik tombol untuk mengunduh berkas materi secara offline</span>
                                </div>
                            </div>
                            <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank" class="btn btn-primary d-inline-flex align-items-center justify-content-center gap-1.5 px-3 py-2 rounded-3 fw-medium">
                                <i class="bi bi-download"></i> Download PDF
                            </a>
                        </div>
                    @elseif($materi->type === 'youtube')
                        @php
                            preg_match('/(?:youtube\.com.*v=|youtu\.be\/)([^&]+)/', $materi->youtube_url, $matches);
                            $videoId = $matches[1] ?? null;
                        @endphp
                        @if($videoId)
                            <div class="ratio ratio-16x9 rounded-3 overflow-hidden shadow-sm border">
                                <iframe src="https://www.youtube.com/embed/{{ $videoId }}"
                                        title="YouTube video"
                                        allowfullscreen
                                        class="rounded-3">
                                </iframe>
                            </div>
                        @else
                            <div class="alert alert-danger border-danger-subtle d-flex align-items-center gap-2 rounded-3" role="alert">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                <span>Link YouTube tidak valid atau tidak dapat diakses</span>
                            </div>
                        @endif
                    @endif
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
