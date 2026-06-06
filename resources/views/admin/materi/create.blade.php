@extends('layouts.app')
@section('title', 'Tambah Materi')

@section('content')

<div class="container-fluid py-3">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-slate-800 mb-1">Tambah Materi</h3>
            <p class="text-secondary mb-0">Buat materi pembelajaran baru</p>
        </div>
        <a href="{{ route('materi.admin.index') }}" class="btn btn-outline-secondary px-3 py-2 rounded-3 d-inline-flex align-items-center gap-1.5 fw-medium">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- FORM GRID --}}
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <form id="createMateriForm">
                        @csrf

                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold text-secondary">Judul Materi</label>
                            <input type="text" class="form-control py-2.5 px-3 rounded-3" id="title" placeholder="Masukkan judul materi..." required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold text-secondary">Deskripsi</label>
                            <textarea class="form-control py-2.5 px-3 rounded-3" id="description" rows="4" placeholder="Tuliskan deskripsi singkat mengenai materi ini..."></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="type" class="form-label fw-semibold text-secondary">Tipe Materi</label>
                            <select class="form-select py-2.5 px-3 rounded-3" id="type">
                                <option value="pdf">PDF</option>
                                <option value="image">Image</option>
                                <option value="youtube">YouTube</option>
                            </select>
                        </div>

                        <div class="mb-4" id="fileGroup">
                            <label for="file" class="form-label fw-semibold text-secondary">File Dokumen / Gambar</label>
                            <input type="file" class="form-control py-2 px-3 rounded-3" id="file">
                            <small class="text-muted d-block mt-1.5">Pilih file berformat PDF atau Gambar sesuai tipe yang dipilih.</small>
                        </div>

                        <div class="mb-4" id="youtubeGroup" style="display:none;">
                            <label for="youtube_url" class="form-label fw-semibold text-secondary">YouTube URL</label>
                            <input type="text" class="form-control py-2.5 px-3 rounded-3" id="youtube_url" placeholder="Contoh: https://www.youtube.com/watch?v=...">
                            <small class="text-muted d-block mt-1.5">Masukkan URL video YouTube yang valid.</small>
                        </div>

                        <hr class="my-4" style="border-color: rgba(226, 232, 240, 0.8);">

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4 py-2.5 rounded-3 shadow-sm fw-medium d-inline-flex align-items-center gap-2">
                                <i class="bi bi-save"></i> Simpan Materi
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
                    <h5 class="fw-semibold text-slate-800 mb-3">Panduan Pengisian</h5>
                    <ul class="list-unstyled mb-0 text-secondary" style="font-size: 0.9rem;">
                        <li class="mb-3 d-flex align-items-start gap-2.5">
                            <i class="bi bi-info-circle text-primary mt-0.5 fs-5"></i>
                            <span>Pastikan memilih tipe materi yang sesuai sebelum mengunggah file.</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start gap-2.5">
                            <i class="bi bi-file-earmark-pdf text-danger mt-0.5 fs-5"></i>
                            <span>Tipe PDF membutuhkan file dokumen PDF yang valid.</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start gap-2.5">
                            <i class="bi bi-image text-success mt-0.5 fs-5"></i>
                            <span>Tipe Image mendukung format gambar standar seperti JPEG atau PNG.</span>
                        </li>
                        <li class="d-flex align-items-start gap-2.5">
                            <i class="bi bi-youtube text-danger mt-0.5 fs-5"></i>
                            <span>Tipe YouTube membutuhkan link video YouTube lengkap.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('type').addEventListener('change', function () {
        const type = this.value;
        document.getElementById('fileGroup').style.display = type === 'youtube' ? 'none' : 'block';
        document.getElementById('youtubeGroup').style.display = type === 'youtube' ? 'block' : 'none';
    });

    document.getElementById('createMateriForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData();

        formData.append('title', document.getElementById('title').value);
        formData.append('description', document.getElementById('description').value);
        formData.append('type', document.getElementById('type').value);

        const type = document.getElementById('type').value;

        if (type === 'youtube') {
            formData.append('youtube_url', document.getElementById('youtube_url').value);
        } else {
            const file = document.getElementById('file').files[0];
            if (file) formData.append('file', file);
        }

        fetch('/api/materi', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(res => {
            if (!res.ok) throw new Error("Request gagal");
            return res.json();
        })
        .then(data => {
            alert('Materi berhasil ditambahkan');
            window.location.href = '/admin/materi';
        })
        .catch(err => {
            console.error(err);
            alert('Gagal menambah materi');
        });
    });
</script>

@endsection
