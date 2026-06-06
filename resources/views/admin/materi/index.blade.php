@extends('layouts.app')

@section('title', 'Kelola Materi')

@section('content')

<div class="container-fluid py-3">

    {{-- HEADER --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold text-slate-800 mb-1">Kelola Materi</h3>
            <p class="text-secondary mb-0">Manajemen materi pembelajaran untuk siswa</p>
        </div>

        <a href="/admin/materi/create" class="btn btn-primary px-4 py-2.5 rounded-3 shadow-sm d-inline-flex align-items-center gap-2 fw-medium">
            <i class="bi bi-plus-lg fs-6"></i> Tambah Materi
        </a>
    </div>

    {{-- SEARCH --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <form method="GET" class="d-flex gap-2">
                <div class="input-group shadow-sm rounded-3 overflow-hidden border bg-white flex-grow-1" style="border-color: rgba(226, 232, 240, 0.8) !important;">
                    <span class="input-group-text border-0 bg-transparent text-secondary pe-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-0 bg-transparent py-2.5 ps-2"
                           placeholder="Cari judul materi..."
                           value="{{ request('search') }}" style="box-shadow: none;">
                    @if(request('search'))
                        <a href="{{ route('materi.admin.index') }}" class="btn border-0 bg-transparent text-secondary d-flex align-items-center pe-3" style="box-shadow: none;">
                            <i class="bi bi-x-circle-fill"></i>
                        </a>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary px-4 rounded-3 shadow-sm d-flex align-items-center">
                    <span>Cari</span>
                </button>
            </form>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th class="py-3 px-4 text-secondary fw-semibold text-uppercase tracking-wider small" width="80">No</th>
                            <th class="py-3 px-4 text-secondary fw-semibold text-uppercase tracking-wider small">Judul & Deskripsi</th>
                            <th class="py-3 px-4 text-secondary fw-semibold text-uppercase tracking-wider small" width="140">Tipe</th>
                            <th class="py-3 px-4 text-secondary fw-semibold text-uppercase tracking-wider small" width="160">Dibuat</th>
                            <th class="py-3 px-4 text-secondary fw-semibold text-uppercase tracking-wider small text-end" width="280">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($materi as $index => $item)
                            <tr>
                                <td class="py-3 px-4 text-secondary fw-medium">
                                    {{ $index + 1 }}
                                </td>

                                <td class="py-3 px-4">
                                    <div class="fw-semibold text-dark mb-1">
                                        {{ $item->title }}
                                    </div>
                                    <div class="text-secondary small text-truncate" style="max-width: 400px;">
                                        {{ $item->description ?? 'Tidak ada deskripsi' }}
                                    </div>
                                </td>

                                <td class="py-3 px-4">
                                    @if($item->type == 'pdf')
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-1.5 fw-medium">
                                            <i class="bi bi-file-earmark-pdf me-1"></i>PDF
                                        </span>
                                    @elseif($item->type == 'image')
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
                                    <div class="d-flex align-items-center gap-1.5">
                                        <i class="bi bi-calendar3"></i>
                                        <span>{{ $item->created_at->format('d M Y') }}</span>
                                    </div>
                                </td>

                                <td class="py-3 px-4 text-end">
                                    <div class="d-flex gap-2 justify-content-end align-items-center">
                                        <a href="/admin/materi/{{ $item->id }}" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1 px-2.5 py-1.5 rounded-3 fw-medium">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>

                                        <a href="/admin/materi/{{ $item->id }}/edit" class="btn btn-sm btn-outline-warning d-inline-flex align-items-center gap-1 px-2.5 py-1.5 rounded-3 fw-medium">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>

                                        <form action="/api/materi/{{ $item->id }}" method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Hapus materi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1 px-2.5 py-1.5 rounded-3 fw-medium">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">
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

