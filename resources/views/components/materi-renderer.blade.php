<div class="materi-renderer">
    {{-- IMAGE --}}
    @if($materi->type === 'image')
        <img
            src="{{ asset('storage/' . $materi->file_path) }}"
            class="img-fluid rounded"
            alt="materi image"
        >
    @endif


    {{-- PDF --}}
    @if($materi->type === 'pdf')
        <iframe
            src="{{ asset('storage/' . $materi->file_path) }}"
            width="100%"
            height="600px"
            style="border: none;"
        ></iframe>

        <div class="mt-2">
            <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank">
                Download PDF
            </a>
        </div>
    @endif


    {{-- YOUTUBE --}}
    @if($materi->type === 'youtube')
        @php
            $videoId = app(\App\View\Components\MateriRenderer::class, ['materi' => $materi])->youtubeId();
        @endphp

        @if($videoId)
            <div class="ratio ratio-16x9">
                <iframe
                    src="https://www.youtube.com/embed/{{ $videoId }}"
                    frameborder="0"
                    allowfullscreen
                ></iframe>
            </div>
        @else
            <p class="text-danger">Link YouTube tidak valid</p>
        @endif
    @endif
</div>
