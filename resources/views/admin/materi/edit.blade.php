@extends('layouts.app')
@section('title', 'Edit Materi')

@section('content')

<div class="materi-container">

    <!-- HEADER -->
    <div class="materi-header d-flex justify-content-between align-items-center mb-4">
        <h2 class="materi-title">Edit Materi</h2>

        <a href="{{ route('materi.admin.index') }}" class="btn btn-light">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- FORM CARD -->
    <div class="materi-search-section">

        <form action="{{ route('materi.admin.update', $materi->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <!-- TITLE -->
            <div class="mb-3">
                <label class="form-label">Judul Materi</label>
                <input type="text"
                       name="title"
                       class="form-control"
                       value="{{ $materi->title }}"
                       required>
            </div>

            <!-- DESCRIPTION -->
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description"
                          class="form-control"
                          rows="4">{{ $materi->description }}</textarea>
            </div>

            <!-- TYPE -->
            <div class="mb-3">
                <label class="form-label">Tipe Materi</label>

                <div class="type-selector">

                    <label class="form-check">
                        <input type="radio" name="type" value="pdf"
                               class="form-check-input"
                               {{ $materi->type == 'pdf' ? 'checked' : '' }}>
                        PDF
                    </label>

                    <label class="form-check">
                        <input type="radio" name="type" value="image"
                               class="form-check-input"
                               {{ $materi->type == 'image' ? 'checked' : '' }}>
                        Image
                    </label>

                    <label class="form-check">
                        <input type="radio" name="type" value="youtube"
                               class="form-check-input"
                               {{ $materi->type == 'youtube' ? 'checked' : '' }}>
                        YouTube
                    </label>

                </div>
            </div>

            <!-- FILE -->
            <div class="mb-3" id="fileBox">
                <label class="form-label">File Baru (opsional)</label>

                <input type="file"
                       name="file"
                       class="form-control">

                @if($materi->file_path)
                    <small class="text-muted">
                        File saat ini:
                        <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank">
                            Lihat file
                        </a>
                    </small>
                @endif
            </div>

            <!-- YOUTUBE -->
            <div class="mb-3" id="youtubeBox">
                <label class="form-label">YouTube URL</label>

                <input type="text"
                    name="youtube_url"
                    class="form-control"
                    value="{{ $materi->youtube_url }}">
            </div>

            <!-- BUTTON -->
            <button class="btn btn-add-materi">
                <i class="bi bi-save me-1"></i> Update Materi
            </button>

        </form>

    </div>
</div>
<script>
function toggleType() {
    const type = document.querySelector('input[name="type"]:checked').value;

    document.getElementById('fileBox').style.display =
        (type === 'youtube') ? 'none' : 'block';

    document.getElementById('youtubeBox').style.display =
        (type === 'youtube') ? 'block' : 'none';
}

document.querySelectorAll('input[name="type"]').forEach(el => {
    el.addEventListener('change', toggleType);
});

toggleType();
</script>

@endsection
