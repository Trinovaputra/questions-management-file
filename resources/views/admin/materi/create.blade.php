@extends('layouts.app')
@section('title', 'Tambah Materi')

@section('content')

<div class="container">
    <h2 class="mb-4">Tambah Materi</h2>

    <form id="createMateriForm">
        @csrf

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" class="form-control" id="title">
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea class="form-control" id="description"></textarea>
        </div>

        <div class="mb-3">
            <label>Tipe</label>
            <select class="form-control" id="type">
                <option value="pdf">PDF</option>
                <option value="image">Image</option>
                <option value="youtube">YouTube</option>
            </select>
        </div>

        <div class="mb-3" id="fileGroup">
            <label>File</label>
            <input type="file" class="form-control" id="file">
        </div>

        <div class="mb-3" id="youtubeGroup" style="display:none;">
            <label>YouTube URL</label>
            <input type="text" class="form-control" id="youtube_url">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
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
