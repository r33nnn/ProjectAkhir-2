@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="hero">
    <div class="container">
        <h1 class="fw-bold">{{ $tentang->header_title ?? 'GBI Tambunan' }}</h1>
        <p class="lead">{{ $tentang->header_description ?? 'Mengenal lebih dekat sejarah, visi, misi, dan keluarga besar kami' }}</p>
    </div>
</section>

<!-- SEJARAH -->
<section class="section bg-light">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">Sejarah Kami</h2>

        <div class="card card-custom p-4 col-md-8 mx-auto" data-aos="fade-up">
            <p>
                {!! $tentang->sejarah ?? 'GBI Tambunan adalah bagian dari sinode Gereja Bethel Indonesia. Kami berkomitmen untuk melayani Tuhan dan membangun komunitas yang bertumbuh dalam iman, pengharapan, dan kasih.' !!}
            </p>
        </div>

        <div class="row mt-5">
            <div class="col-md-6 mb-4" data-aos="fade-right">
                <div class="card card-custom p-4 text-center">
                    <div class="icon-box-lg bg-soft-blue mb-3">
                        <i class="fa-solid fa-calendar"></i>
                    </div>
                    <h5>{{ $tentang->tahun_berdiri ?? $gereja['tahun_berdiri'] ?? '1970' }}</h5>
                    <p>Berdirinya Gereja Bethel Indonesia</p>
                </div>
            </div>

            <div class="col-md-6 mb-4" data-aos="fade-left">
                <div class="card card-custom p-4 text-center">
                    <div class="icon-box-lg bg-soft-green mb-3">
                        <i class="fa-solid fa-people-group"></i>
                    </div>
                    <h5>Sekarang</h5>
                    <p>Melayani komunitas lokal dengan kasih Kristus</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- VISI MISI -->
<section class="section">
    <div class="container text-center">
        <h2 class="fw-bold mb-5">Visi & Misi</h2>

        <div class="row">
            <div class="col-md-6 mb-4" data-aos="zoom-in">
                <div class="card card-custom p-5">
                    <div class="icon-box bg-soft-blue mb-3">
                    <i class="fa-solid fa-eye"></i>
                    </div>
                    <h5>Visi</h5>
                    <p>
                        {!! $tentang->visi ?? 'Membangun gereja yang kuat dalam iman dan pengharapan' !!}
                    </p>
                </div>
            </div>

            <div class="col-md-6 mb-4" data-aos="zoom-in">
                <div class="card card-custom p-5">
                    <div class="icon-box bg-soft-orange mb-3">
                        <i class="fa-solid fa-handshake"></i>
                    </div>
                    <h5>Misi</h5>
                    <p>
                        {!! $tentang->misi ?? 'Melayani Tuhan dengan sepenuh hati dan mengasihi sesama' !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- KEPEMIMPINAN -->
<section class="section bg-light">
    <div class="container text-center">
        <h2 class="fw-bold mb-5">Kepemimpinan</h2>

        <div class="card card-custom p-5 col-md-8 mx-auto" data-aos="fade-up">
            @if($tentang && $tentang->gembala_foto)
                <img src="{{ asset('storage/' . $tentang->gembala_foto) }}" class="leadership-img mb-3" alt="Gembala" style="max-width: 150px; border-radius: 10px;">
            @else
                <img src="https://via.placeholder.com/150" class="leadership-img mb-3" alt="Gembala">
            @endif
            <h5>{{ $tentang->gembala_nama ?? 'Gembala Sidang' }}</h5>
            <small class="text-muted">{{ $tentang->gembala_jabatan ?? 'Pemimpin Rohani' }}</small>
            <p class="mt-3">
                {!! $tentang->gembala_deskripsi ?? 'Sebagai gembala, kami berkomitmen untuk memimpin jemaat dalam kasih Kristus.' !!}
            </p>
        </div>
    </div>
</section>

@endsection
