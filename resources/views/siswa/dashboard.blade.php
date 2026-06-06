@extends('layouts.app')
@section('title', 'Dashboard Siswa')
@section('content')

<div class="content-grid">
    <!-- Welcome Section -->
    <div class="welcome-section">
        <h2>Selamat Datang, {{ auth()->user()->name }}! 👋</h2>
        <p>Pilih materi yang ingin Anda pelajari untuk memulai.</p>
    </div>

    <!-- Materi Section -->
    <div class="dashboard-card">
        <h3 class="card-title">
            <i class="bi bi-book me-2"></i>Materi Terbaru
        </h3>

        <div class="row g-3">
            @foreach($materiTerbaru as $materi)
                <div class="col-md-4">
                    <div class="materi-card">
                        <h5 class="materi-title">
                            {{ $materi->title }}
                        </h5>

                        <p class="materi-desc">
                            {{ Str::limit($materi->description ?? 'Tidak ada deskripsi', 80) }}
                        </p>

                        <a href="{{ route('materi.show', $materi->id) }}" class="materi-link">
                            Pelajari <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row g-3">
        <div class="col-md-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon materi-icon">
                    <i class="bi bi-book-half"></i>
                </div>
                <h6 class="stat-label">Total Materi</h6>
                <p class="stat-value">{{ $totalMateri }}</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon activity-icon">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <h6 class="stat-label">Hari Ini</h6>
                <p class="stat-value">{{ date('d M') }}</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon achievement-icon">
                    <i class="bi bi-trophy"></i>
                </div>
                <h6 class="stat-label">Pencapaian</h6>
                <p class="stat-value">0</p>
            </div>
        </div>
    </div>
</div>

<style>
    .materi-card {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 0.6rem;
        padding: 1.5rem;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: var(--transition);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .materi-card:hover {
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.1);
        transform: translateY(-2px);
    }

    .materi-header {
        font-size: 2.5rem;
        color: var(--secondary-color);
        margin-bottom: 1rem;
    }

    .materi-title {
        font-size: 1rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }

    .materi-desc {
        font-size: 0.85rem;
        color: #64748b;
        margin-bottom: 1rem;
        flex: 1;
    }

    .materi-link {
        display: inline-flex;
        align-items: center;
        color: var(--secondary-color);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: var(--transition);
    }

    .materi-link:hover {
        color: #5a57d8;
        gap: 0.5rem;
    }

    .stat-card {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 0.6rem;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        transition: var(--transition);
    }

    .stat-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
        font-size: 2rem;
        margin-bottom: 1rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

    .materi-icon {
        background: rgba(79, 70, 229, 0.1);
        color: var(--secondary-color);
    }

    .progress-icon {
        background: rgba(34, 197, 94, 0.1);
        color: #22c55e;
    }

    .activity-icon {
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
    }

    .achievement-icon {
        background: rgba(251, 191, 36, 0.1);
        color: var(--accent-color);
    }

    .stat-label {
        font-size: 0.85rem;
        color: #64748b;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .stat-value {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }

    .row {
        --bs-gutter-x: 1.5rem;
        --bs-gutter-y: 1.5rem;
    }

    @media (max-width: 768px) {
        .materi-card {
            padding: 1.25rem;
        }

        .stat-card {
            padding: 1.25rem;
        }

        .stat-value {
            font-size: 1.5rem;
        }
    }
</style>

@endsection
