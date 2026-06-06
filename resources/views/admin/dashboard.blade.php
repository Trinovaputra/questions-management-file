@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')

<div class="container-fluid py-3">

    {{-- HEADER --}}
    <div class="mb-4">
        <h3 class="fw-bold text-slate-800">Dashboard Admin</h3>
        <p class="text-secondary mb-0">Ringkasan data sistem pembelajaran</p>
    </div>

    {{-- TOTAL CARD --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm overflow-hidden">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-secondary mb-1 fw-semibold text-uppercase tracking-wider small" style="letter-spacing: 0.05em;">Total Materi</p>
                            <h2 class="fw-bold mb-0 text-dark" style="font-size: 2.25rem;">{{ $totalMateri }}</h2>
                        </div>
                        <div class="p-3 bg-primary-subtle text-primary rounded-3">
                            <i class="bi bi-book-half fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 px-4 d-flex align-items-center justify-content-between">
            <h5 class="mb-0 fw-semibold text-slate-800">Materi Terbaru</h5>
            <span class="badge bg-light text-secondary border px-2 py-1.5 fw-medium">Baru ditambahkan</span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3 px-4 text-secondary fw-semibold text-uppercase tracking-wider small">Judul</th>
                            <th class="py-3 px-4 text-secondary fw-semibold text-uppercase tracking-wider small">Tipe</th>
                            <th class="py-3 px-4 text-secondary fw-semibold text-uppercase tracking-wider small">Dibuat Oleh</th>
                            <th class="py-3 px-4 text-secondary fw-semibold text-uppercase tracking-wider small">Tanggal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($latestMateri as $materi)
                            <tr>
                                <td class="py-3 px-4 fw-semibold text-dark">
                                    {{ $materi->title }}
                                </td>

                                <td class="py-3 px-4">
                                    @if($materi->type == 'pdf')
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-1.5 fw-medium">
                                            <i class="bi bi-file-earmark-pdf me-1"></i>PDF
                                        </span>
                                    @elseif($materi->type == 'image')
                                        <span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill px-3 py-1.5 fw-medium">
                                            <i class="bi bi-image me-1"></i>IMAGE
                                        </span>
                                    @else
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-1.5 fw-medium">
                                            <i class="bi bi-youtube me-1"></i>YOUTUBE
                                        </span>
                                    @endif
                                </td>

                                <td class="py-3 px-4 text-secondary">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-person-circle text-secondary me-2 fs-5"></i>
                                        <span>{{ $materi->creator->name ?? 'Admin' }}</span>
                                    </div>
                                </td>

                                <td class="py-3 px-4 text-secondary">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-calendar3 text-secondary me-2"></i>
                                        <span>{{ $materi->created_at->format('d M Y') }}</span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-5">
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <i class="bi bi-inbox fs-1 text-muted mb-2 opacity-50"></i>
                                        <span class="fw-medium">Belum ada materi</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>

@endsection

