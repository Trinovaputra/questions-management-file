<div class="materi-renderer">
    {{-- IMAGE --}}
    @if($materi->type === 'image')
        <div class="text-center p-3 bg-light border rounded-3">
            <img
                src="{{ asset('storage/' . $materi->file_path) }}"
                class="img-fluid rounded shadow-sm border"
                alt="materi image"
                style="max-height: 550px; object-fit: contain;"
            >
        </div>
    @endif


    {{-- PDF --}}
    @if($materi->type === 'pdf')
        <div class="bg-light border rounded-3 p-1 mb-3">
            <iframe
                src="{{ asset('storage/' . $materi->file_path) }}"
                width="100%"
                height="600px"
                style="border: none;"
                class="rounded-3"
            ></iframe>
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
    @endif


    {{-- YOUTUBE --}}
    @if($materi->type === 'youtube')
        @php
            $videoId = app(\App\View\Components\MateriRenderer::class, ['materi' => $materi])->youtubeId();
        @endphp

        @if($videoId)
            <div class="ratio ratio-16x9 rounded-3 overflow-hidden shadow-sm border">
                <iframe
                    src="https://www.youtube.com/embed/{{ $videoId }}"
                    frameborder="0"
                    allowfullscreen
                    class="rounded-3"
                ></iframe>
            </div>
        @else
            <div class="alert alert-danger border-danger-subtle d-flex align-items-center gap-2 rounded-3" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span>Link YouTube tidak valid atau tidak dapat diakses</span>
            </div>
        @endif
    @endif
</div>
