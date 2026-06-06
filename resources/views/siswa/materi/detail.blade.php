@extends('layouts.app')
@section('title', $materi->title)
@section('content')

<div class="container py-4">
    <!-- BACK BUTTON -->
    <a href="{{ route('materi.index') }}" class="btn btn-light mb-3">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
    <div class="row g-4">
        <!-- MAIN CONTENT -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <!-- HEADER -->
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">{{ $materi->title }}</h4>
                    <small class="opacity-75">
                        Tipe: {{ strtoupper($materi->type) }}
                    </small>
                </div>
                <!-- BODY -->
                <div class="card-body">
                    <h6 class="text-muted">Deskripsi</h6>
                    <p class="mb-4">
                        {{ $materi->description ?? 'Tidak ada deskripsi.' }}
                    </p>
                    <hr>

                    <!-- CONTENT RENDER -->
                    @if($materi->type === 'image')
                        <img src="{{ asset('storage/' . $materi->file_path) }}"
                             class="img-fluid rounded shadow-sm"
                             alt="materi">
                    @elseif($materi->type === 'pdf')
                        <iframe src="{{ asset('storage/' . $materi->file_path) }}#toolbar=0&navpanes=0&scrollbar=0"
                            width="100%"
                            height="600px"
                            style="border: none;">
                        </iframe>
                    @elseif($materi->type === 'youtube')
                        @php
                            preg_match('/(?:youtube\.com.*v=|youtu\.be\/)([^&]+)/', $materi->youtube_url, $matches);
                            $videoId = $matches[1] ?? null;
                        @endphp
                        @if($videoId)
                            <div class="ratio ratio-16x9">
                                <iframe src="https://www.youtube.com/embed/{{ $videoId }}"
                                        title="YouTube video"
                                        allowfullscreen>
                                </iframe>
                            </div>
                        @else
                            <p class="text-danger">Link YouTube tidak valid</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <!-- SIDEBAR -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <h6 class="text-muted">Info Materi</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <strong>Jenis:</strong> {{ strtoupper($materi->type) }}
                        </li>
                        <li class="mb-2">
                            <strong>Dibuat:</strong> {{ $materi->created_at->format('d M Y') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
