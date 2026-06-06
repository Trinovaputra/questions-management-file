@extends('layouts.app')
@section('title', 'Materi Pembelajaran')
@section('content')

<div class="content-grid">

    <!-- Header -->
    <div class="dashboard-card">
        <h2 class="card-title">
            <i class="bi bi-book me-2"></i>Materi Pembelajaran
        </h2>
        <p class="card-subtitle">Pilih materi untuk mulai belajar</p>
    </div>

    @if($materis->count() > 0)

        <div class="row g-3">
            @foreach($materis as $materi)

                <div class="col-md-6 col-lg-4">
                    <div class="materi-card-full">

                        <!-- HEADER BIRU -->
                        <div class="materi-card-header">
                            <div>
                                <h5 class="materi-title">
                                    {{ $materi->title }}
                                </h5>

                                <span class="materi-type">
                                    <i class="bi bi-book me-1"></i>
                                    {{ strtoupper($materi->type) }}
                                </span>
                            </div>
                        </div>

                        <!-- BODY -->
                        <div class="materi-card-body">

                            <p class="materi-card-text">
                                {{ Str::limit($materi->description ?? 'Tidak ada deskripsi', 120) }}
                            </p>

                            <div class="materi-card-footer">
                                <a href="{{ route('materi.show', $materi->id) }}"
                                   class="btn btn-primary btn-sm">
                                    <i class="bi bi-play-fill me-1"></i>Mulai
                                </a>
                            </div>

                        </div>

                    </div>
                </div>

            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $materis->links() }}
        </div>

    @else
        <div class="dashboard-card">
            <div class="empty-state">
                <i class="bi bi-inbox fs-1"></i>
                <h4>Belum Ada Materi</h4>
                <p>Materi akan segera tersedia</p>
            </div>
        </div>
    @endif

</div>

@endsection
