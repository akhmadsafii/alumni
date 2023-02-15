@extends('layout.guest.v_main')
@section('content')
    @push('styles')
        <style>
            .line {
                display: block;
            }

            .line h2 {
                font-size: 22px;
                border-bottom: 2px solid #2155c0;
            }

            .line h2 span {
                background-color: white;
                position: relative;
                top: 13px;
            }

            .img-blog {
                background-size: 100%;
                background-position: center center;
                background-repeat: no-repeat;
                height: 150px;
                width: 100%;
                transition: background ease-out 200ms;
            }

            .img-agenda {
                background-size: 100%;
                background-position: center center;
                background-repeat: no-repeat;
                height: 135px;
                width: 100%;
                transition: background ease-out 200ms;
            }
        </style>
    @endpush
    <section class="hero-section" id="hero">

        <div class="wave">

            <svg width="100%" height="355px" viewBox="0 0 1920 355" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
                        <path
                            d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,757 L1017.15166,757 L0,757 L0,439.134243 Z"
                            id="Path"></path>
                    </g>
                </g>
            </svg>

        </div>

        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 hero-text-image">
                    <div class="row">
                        <div class="col-lg-5 text-center text-lg-start">
                            <h1 data-aos="fade-right">Cek Alumni Sekarang</h1>
                            <p class="mb-5" data-aos="fade-right" data-aos-delay="100">Lorem ipsum dolor sit amet,
                                consectetur
                                adipisicing elit.</p>
                            <p data-aos="fade-right" data-aos-delay="200" data-aos-offset="-500"><a href="#"
                                    class="btn btn-outline-white">Cek Sekarang</a></p>
                        </div>
                        <div class="col-lg-7 iphone-wrap">
                            <center>
                                <img src="{{ asset('asset/guest/img/banner.png') }}" alt="Image" class="phone-1"
                                    data-aos="fade-right">
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="section pt-4">
        <div class="container">
            <span class="line">
                <h2><span class="py-2 pe-2">Survey</span></h2>
            </span>
            <p class="mt-3">pelacakan jejak lulusan/alumni yang dilakukan kepada alumni 2 tahun setelah lulus . Tracer
                study bertujuan untuk mengetahui outcomependidikan dalam bentuk transisi dari dunia pendidikan tinggi ke
                dunia kerja</p>

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the card's content.</p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the card's content.</p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the card's content.</p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section pt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <span class="line">
                        <h2><span class="py-2 pe-2">Blog</span></h2>
                    </span>
                    <p class="mt-3"><a href="" class="text-primary">Lihat semua Berita dan Artikel</a></p>
                    <div class="row">
                        @foreach ($blogs as $blog)
                            <div class="col-md-6">
                                <div class="card mb-3 p-1">
                                    <div class="card-img-top img-blog"
                                        style="background-image: url('{{ $blog['file'] != null ? asset($blog['file']) : asset('asset/img/no_image.jpeg') }}')">
                                    </div>
                                    <div class="card-body" style="min-height: 200px;">
                                        <h5 class="card-title mb-0">{{ $blog['title'] }}</h5>
                                        <small>{{ $blog['created_at']->diffForHumans() }}</small>
                                        <p class="card-text mt-2">{!! Str::limit($blog['content'], 200) !!}</p>
                                        <a href="#">Read Post</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6">
                    <span class="line">
                        <h2><span class="py-2 pe-2">Agenda</span></h2>
                    </span>
                    <p class="mt-3"><a href="" class="text-primary">Lihat semua Agenda dalam bulan ini</a></p>
                    @foreach ($agendas as $agenda)
                        <div class="card mb-3 p-1">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <div class="img-fluid rounded-start img-agenda"
                                        style="background-image: url('{{ $agenda['file'] != null ? asset($agenda['file']) : asset('asset/img/no_image.jpeg') }}')">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title mb-0">{{ $agenda['title'] }}</h5>
                                        <small>Waktu : {{ DateHelper::getTanggal($agenda['start_date']) }}</small>
                                        <p class="card-text mt-2">{!! Str::limit($agenda['description'], 80) !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>
@endsection
