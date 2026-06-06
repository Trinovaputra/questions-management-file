@extends('layouts.app')
@section('title', 'Detail Materi')

@section('content')

<div class="container">

    <h2>{{ $materi->title }}</h2>
    <p class="text-muted">{{ $materi->description }}</p>

    <hr>

    <p><strong>Tipe:</strong> {{ strtoupper($materi->type) }}</p>
    <p><strong>Dibuat:</strong> {{ $materi->created_at }}</p>

    <x-materi-renderer :materi="$materi" />

    <div class="mt-4">
        <a href="/admin/materi/{{ $materi->id }}/edit" class="btn btn-warning">Edit</a>
        <a href="/admin/materi" class="btn btn-secondary">Kembali</a>
    </div>

</div>

@endsection
