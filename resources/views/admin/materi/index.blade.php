@extends('layouts.app')

@section('title', 'Kelola Materi')

@section('content')

<div class="container">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Kelola Materi</h2>
            <p class="text-muted mb-0">Manajemen materi pembelajaran</p>
        </div>

        <a href="/admin/materi/create" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Materi
        </a>
    </div>

    {{-- SEARCH --}}
    <form method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control"
                   placeholder="Cari judul materi..."
                   value="{{ request('search') }}">

            <button class="btn btn-outline-primary">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </form>

    {{-- TABLE --}}
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Tipe</th>
                        <th>Dibuat</th>
                        <th width="220">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($materi as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td>
                                <div class="fw-semibold">
                                    {{ $item->title }}
                                </div>
                                <small class="text-muted">
                                    {{ Str::limit($item->description, 60) }}
                                </small>
                            </td>

                            <td>
                                @if($item->type == 'pdf')
                                    <span class="badge bg-danger">PDF</span>
                                @elseif($item->type == 'image')
                                    <span class="badge bg-info">Image</span>
                                @else
                                    <span class="badge bg-danger">YouTube</span>
                                @endif
                            </td>

                            <td>
                                <small class="text-muted">
                                    {{ $item->created_at->format('d M Y') }}
                                </small>
                            </td>

                            <td>
                                <a href="/admin/materi/{{ $item->id }}" class="btn btn-sm btn-info">
                                    Detail
                                </a>

                                <a href="/admin/materi/{{ $item->id }}/edit" class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form action="/api/materi/{{ $item->id }}" method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Hapus materi ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                Belum ada materi
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>

@endsection
