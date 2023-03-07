@extends('layout.guest.v_main')
@section('content')
    @push('styles')
        <style>
            .my-card {
                position: absolute;
                top: -20px;
            }
        </style>
    @endpush
    <section class="hero-section inner-page">
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
                <div class="col-12">
                    <div class="row justify-content-center">
                        <div class="col-md-7 text-center hero-text">
                            <h1 data-aos="fade-up" data-aos-delay="" class="aos-init aos-animate">Survey</h1>
                            <p class="mb-5 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">Pelacakan jejak
                                lulusan/alumni yang dilakukan kepada alumni 2 tahun setelah
                                lulus . Survey bertujuan untuk mengetahui outcomependidikan dalam bentuk transisi dari dunia
                                pendidikan tinggi ke dunia kerja</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if ($categories->isNotEmpty())
        <section class="section pt-3">
            <div class="container">
                <div class="row">
                    @foreach ($categories as $category)
                        @if ($category['surveys_count'] != 0)
                            <div class="col-md-4">
                                <div class="card border-info mx-sm-1 p-2 m-3">
                                    <div class="card border-info shadow text-info p-3 my-card"><i
                                            class="bi bi-bar-chart-line-fill" style="font-size:26px;"></i></div>
                                    <div class="text-info text-center mt-5">
                                        <h4>{{ strtoupper($category['name']) }}</h4>
                                    </div>
                                    <div class="text-info text-center mt-2">
                                        <h1>{{ $category['surveys_count'] }} Soal</h1>
                                    </div>
                                    <div class="content">
                                        <div class="d-flex justify-content-around">
                                            <a href="" class="btn btn-primary btn-sm mx-1"><i
                                                    class="bi bi-info-circle-fill"></i> Detail</a>
                                            <a href="{{ route('survey.survey', $category['code']) }}"
                                                class="btn btn-success btn-sm mx-1"><i class="bi bi-play-circle-fill"></i>
                                                Mulai</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    {{ $categories->links() }}
                </div>
            </div>
        </section>
    @else
        <section class="section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4 me-auto">
                        <h2 class="mb-4">Survey tidak tersedia</h2>
                        <p class="mb-4">Untuk saat ini belum ada survey yang ingin diisi. Silahkan akses dan coba dilain
                            waktu kembali</p>
                    </div>
                    <div class="col-md-6 aos-init aos-animate" data-aos="fade-left"> <img
                            src="{{ asset('asset/guest/img/empty.svg') }}" alt="Image" class="img-fluid"></div>
                </div>
            </div>
        </section>
    @endif

@endsection
