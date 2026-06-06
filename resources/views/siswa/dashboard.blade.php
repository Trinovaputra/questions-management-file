@extends('layouts.app')
@section('title', 'Dashboard Siswa')
@section('content')

<div class="container-fluid py-3">
    <!-- Welcome Section -->
    <div class="welcome-section mb-4 p-4 p-md-5 text-white rounded-3 shadow" style="background: linear-gradient(135deg, #1591DC 0%, #4f46e5 100%);">
        <div class="d-flex align-items-center gap-3">
            <div>
                <h2 class="fw-bold mb-1">Selamat Datang, {{ auth()->user()->name }}! 👋</h2>
                <p class="mb-0 opacity-90">Pilih materi yang ingin Anda pelajari untuk memulai perjalanan belajar hari ini.</p>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm overflow-hidden h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="p-3 bg-primary-subtle text-primary rounded-3">
                            <i class="bi bi-book-half fs-3"></i>
                        </div>
                        <div>
                            <p class="text-secondary mb-1 fw-semibold text-uppercase tracking-wider small" style="letter-spacing: 0.05em;">Total Materi</p>
                            <h3 class="fw-bold mb-0 text-slate-800">{{ $totalMateri }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card border-0 shadow-sm overflow-hidden h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="p-3 bg-success-subtle text-success rounded-3">
                            <i class="bi bi-calendar-check fs-3"></i>
                        </div>
                        <div>
                            <p class="text-secondary mb-1 fw-semibold text-uppercase tracking-wider small" style="letter-spacing: 0.05em;">Hari Ini</p>
                            <h3 class="fw-bold mb-0 text-slate-800">{{ date('d M Y') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm overflow-hidden h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="p-3 bg-warning-subtle text-warning rounded-3">
                            <i class="bi bi-trophy fs-3"></i>
                        </div>
                        <div>
                            <p class="text-secondary mb-1 fw-semibold text-uppercase tracking-wider small" style="letter-spacing: 0.05em;">Pencapaian</p>
                            <h3 class="fw-bold mb-0 text-slate-800">0</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Materi Section -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 px-4 d-flex align-items-center">
            <h5 class="mb-0 fw-semibold text-slate-800">
                <i class="bi bi-book text-primary me-2"></i>Materi Terbaru
            </h5>
        </div>

        <div class="card-body p-4 bg-light-subtle">
            <div class="row g-4">
                @forelse($materiTerbaru as $materi)
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

                                <h5 class="fw-bold text-dark mb-2" style="font-size: 1.05rem;">{{ $materi->title }}</h5>
                                <p class="text-secondary small mb-4 flex-grow-1" style="line-height: 1.6;">
                                    {{ Str::limit($materi->description ?? 'Tidak ada deskripsi materi.', 100) }}
                                </p>

                                <div class="mt-auto pt-3 border-top border-light-subtle">
                                    <a href="{{ route('materi.show', $materi->id) }}" class="text-decoration-none fw-semibold text-primary d-inline-flex align-items-center gap-1 small learn-more-link">
                                        Pelajari Materi <i class="bi bi-arrow-right transition-arrow"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 py-5 text-center text-secondary">
                        <i class="bi bi-inbox fs-1 text-muted opacity-50 mb-2 d-block"></i>
                        <span class="fw-medium">Belum ada materi pembelajaran yang tersedia.</span>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
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
    .learn-more-link {
        transition: color 0.2s ease;
    }
    .learn-more-link:hover {
        color: #3b82f6 !important;
    }
    .learn-more-link:hover .transition-arrow {
        transform: translateX(4px);
    }
    .transition-arrow {
        transition: transform 0.2s ease;
    }
</style>

@endsection
