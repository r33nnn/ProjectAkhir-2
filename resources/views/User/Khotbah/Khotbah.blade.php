@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="py-5 bg-light">
<div class="container">
    <h1 class="display-4 fw-bold text-center mb-3">Khotbah</h1>
    <p class="text-center text-muted">Mendengarkan firman Tuhan untuk kehidupan yang lebih bermakna</p>
</div>
</section>

<!-- Sermon List -->
<section class="py-5">
<div class="container">
    <div class="row g-4">
        @forelse($khotbahs as $khotbah)
        <div class="col-md-6 col-lg-4">
            <div class="card-sermon bg-primary text-white">
                <div class="sermon-image">
                    <div class="text-center">
                        <i class="sermon-icon bi bi-play-circle"></i>
                        <p class="mt-2 mb-0">{{ $khotbah->penceramah ?? 'Khotbah' }}</p>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $khotbah->judul }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($khotbah->catatan ?? '', 100) }}</p>
                    <small class="text-secondary">{{ $khotbah->tanggal_khotbah ?? date('d M Y') }}</small>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                Belum ada khotbah tersedia
            </div>
        </div>
        @endforelse
    </div>
</div>
</section>

@endsection
