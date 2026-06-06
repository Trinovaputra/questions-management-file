@extends('layouts.app')
@section('title', 'Edit Materi')

@section('content')

<div class="container-fluid py-3">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-slate-800 mb-1">Edit Materi</h3>
            <p class="text-secondary mb-0">Ubah materi pembelajaran yang sudah ada</p>
        </div>

        <a href="{{ route('materi.admin.index') }}" class="btn btn-outline-secondary px-3 py-2 rounded-3 d-inline-flex align-items-center gap-1.5 fw-medium">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- FORM GRID -->
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">

                    <form action="{{ route('materi.admin.update', $materi->id) }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <!-- TITLE -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-secondary">Judul Materi</label>
                            <input type="text"
                                   name="title"
                                   class="form-control py-2.5 px-3 rounded-3"
                                   value="{{ $materi->title }}"
                                   placeholder="Masukkan judul materi..."
                                   required>
                        </div>

                        <!-- DESCRIPTION -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-secondary">Deskripsi</label>
                            <textarea name="description"
                                      class="form-control py-2.5 px-3 rounded-3"
                                      rows="4"
                                      placeholder="Tuliskan deskripsi singkat mengenai materi ini...">{{ $materi->description }}</textarea>
                        </div>

                        <!-- TYPE -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-secondary d-block">Tipe Materi</label>
                            <div class="d-flex gap-4 flex-wrap bg-light p-3 rounded-3 border">
                                <div class="form-check">
                                    <input type="radio" name="type" value="pdf"
                                           class="form-check-input"
                                           id="typePdf"
                                           {{ $materi->type == 'pdf' ? 'checked' : '' }}>
                                    <label class="form-check-label fw-medium text-secondary" for="typePdf">
                                        <i class="bi bi-file-earmark-pdf text-danger me-1"></i>PDF Document
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input type="radio" name="type" value="image"
                                           class="form-check-input"
                                           id="typeImage"
                                           {{ $materi->type == 'image' ? 'checked' : '' }}>
                                    <label class="form-check-label fw-medium text-secondary" for="typeImage">
                                        <i class="bi bi-image text-success me-1"></i>Image
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input type="radio" name="type" value="youtube"
                                           class="form-check-input"
                                           id="typeYoutube"
                                           {{ $materi->type == 'youtube' ? 'checked' : '' }}>
                                    <label class="form-check-label fw-medium text-secondary" for="typeYoutube">
                                        <i class="bi bi-youtube text-danger me-1"></i>YouTube Video
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- FILE -->
                        <div class="mb-4" id="fileBox">
                            <label class="form-label fw-semibold text-secondary">File Baru (opsional)</label>
                            <input type="file"
                                   name="file"
                                   class="form-control py-2 px-3 rounded-3">

                            @if($materi->file_path)
                                <div class="mt-3 p-3 bg-light border rounded-3 d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2">
                                    <span class="text-secondary small d-inline-flex align-items-center gap-1.5">
                                        <i class="bi bi-file-earmark-check fs-5 text-success"></i>
                                        <span>File saat ini tersedia di penyimpanan</span>
                                    </span>
                                    <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary py-1.5 px-3 rounded-3 fw-medium d-inline-flex align-items-center gap-1">
                                        <i class="bi bi-eye"></i> Lihat file
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- YOUTUBE -->
                        <div class="mb-4" id="youtubeBox">
                            <label class="form-label fw-semibold text-secondary">YouTube URL</label>
                            <input type="text"
                                name="youtube_url"
                                class="form-control py-2.5 px-3 rounded-3"
                                placeholder="Contoh: https://www.youtube.com/watch?v=..."
                                value="{{ $materi->youtube_url }}">
                        </div>

                        <hr class="my-4" style="border-color: rgba(226, 232, 240, 0.8);">

                        <!-- BUTTONS -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4 py-2.5 rounded-3 shadow-sm fw-medium d-inline-flex align-items-center gap-2">
                                <i class="bi bi-save"></i> Update Materi
                            </button>
                            <a href="{{ route('materi.admin.index') }}" class="btn btn-light px-4 py-2.5 rounded-3 fw-medium">
                                Batal
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        <!-- SIDE INFO CARD -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm" style="background-color: #f8fafc;">
                <div class="card-body p-4">
                    <h5 class="fw-semibold text-slate-800 mb-3">Informasi Tambahan</h5>
                    <ul class="list-unstyled mb-0 text-secondary" style="font-size: 0.9rem;">
                        <li class="mb-3 d-flex align-items-start gap-2.5">
                            <i class="bi bi-exclamation-circle text-warning mt-0.5 fs-5"></i>
                            <span>Mengubah tipe materi akan menyesuaikan tampilan input yang dibutuhkan.</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start gap-2.5">
                            <i class="bi bi-check2-circle text-success mt-0.5 fs-5"></i>
                            <span>Jika tipe materi PDF/Image diubah ke YouTube, file lama tidak akan ditampilkan.</span>
                        </li>
                        <li class="d-flex align-items-start gap-2.5">
                            <i class="bi bi-clock-history text-primary mt-0.5 fs-5"></i>
                            <span>Tanggal pembaruan materi akan otomatis tercatat oleh sistem.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
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
