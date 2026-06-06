@extends('layouts.app')
@section('title', 'Materi Pembelajaran')
@section('content')

<div class="container-fluid py-3">

    <!-- Header -->
    <div class="mb-4">
        <h3 class="fw-bold text-slate-800 mb-1">Materi Pembelajaran</h3>
        <p class="text-secondary mb-0">Pilih materi pembelajaran di bawah untuk mulai belajar</p>
    </div>

    @if($materis->count() > 0)

        <div class="row g-4">
            @foreach($materis as $materi)

                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 materi-interactive-card">
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="mb-3 d-flex align-items-center justify-content-between">
                                @if($materi->type == 'pdf')
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2.5 py-1 fw-medium small">
                                        <i class="bi bi-file-earmark-pdf me-1"></i>PDF
                                    </span>
                                @elseif($materi->type == 'image')
                                    <span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill px-2.5 py-1 fw-medium small">
                                        <i class="bi bi-image me-1"></i>IMAGE
                                    </span>
                                @else
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5 py-1 fw-medium small">
                                        <i class="bi bi-youtube me-1"></i>YOUTUBE
                                    </span>
                                @endif
                                <small class="text-secondary small">{{ $materi->created_at->format('d M Y') }}</small>
                            </div>

                            <h5 class="fw-bold text-dark mb-2" style="font-size: 1.1rem; line-height: 1.4;">{{ $materi->title }}</h5>
                            <p class="text-secondary small mb-4 flex-grow-1" style="line-height: 1.6;">
                                {{ Str::limit($materi->description ?? 'Tidak ada deskripsi materi.', 120) }}
                            </p>

                            <div class="mt-auto pt-3 border-top border-light-subtle">
                                <a href="{{ route('materi.show', $materi->id) }}" class="btn btn-primary w-100 py-2.5 rounded-3 shadow-sm fw-semibold d-inline-flex align-items-center justify-content-center gap-1.5">
                                    <i class="bi bi-book-half"></i> Mulai Belajar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {{ $materis->links() }}
        </div>

    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body py-5 text-center text-secondary">
                <i class="bi bi-inbox fs-1 text-muted opacity-50 mb-2 d-block"></i>
                <h5 class="fw-semibold text-slate-800">Belum Ada Materi</h5>
                <p class="text-secondary small mb-0">Materi pembelajaran akan segera tersedia untuk Anda</p>
            </div>
        </div>
    @endif

</div>

<style>
    .materi-interactive-card {
        transition: transform 0.25s ease, box-shadow 0.25s ease !important;
        border: 1px solid rgba(226, 232, 240, 0.8) !important;
    }
    .materi-interactive-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 20px -8px rgba(0, 0, 0, 0.1) !important;
        border-color: rgba(79, 70, 229, 0.2) !important;
    }
</style>

@endsection
