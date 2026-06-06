@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="mb-4">
        <h3 class="fw-bold">Dashboard Admin</h3>
        <p class="text-muted">Ringkasan data sistem pembelajaran</p>
    </div>

    {{-- TOTAL CARD --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted">Total Materi</h6>
                    <h2 class="fw-bold text-primary">{{ $totalMateri }}</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <h5 class="mb-0">Materi Terbaru</h5>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Judul</th>
                            <th>Tipe</th>
                            <th>Dibuat Oleh</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($latestMateri as $materi)
                            <tr>
                                <td class="fw-semibold">
                                    {{ $materi->title }}
                                </td>

                                <td>
                                    <span class="badge
                                        @if($materi->type == 'pdf') bg-warning
                                        @elseif($materi->type == 'image') bg-info
                                        @else bg-danger @endif">
                                        {{ strtoupper($materi->type) }}
                                    </span>
                                </td>

                                <td>
                                    {{ $materi->creator->name ?? 'Admin' }}
                                </td>

                                <td>
                                    {{ $materi->created_at->format('d M Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    Belum ada materi
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
