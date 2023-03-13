@extends('layout.guest.v_main')
@section('content')
    @push('styles')
        @include('package.swipper.swipper_css')
        <style>
            .slick-prev:before,
            .slick-next:before {
                color: rgb(40, 108, 197);
            }

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


            @if ($categories->isNotEmpty())
                <div class="row reviews-page-carousel">
                    @foreach ($categories as $ctg)
                        <div class="col-md-4">
                            <div class="card m-1">
                                <div class="card-content">
                                    <div class="card-body cleartfix">
                                        <div class="media d-flex">
                                            <div class="align-self-center me-2 text-success">
                                                <i class="bi bi-check2-circle" style="font-size:42px;"></i>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="card-title"> {{ ucfirst($ctg['name']) }}</h5>
                                                <p class="card-text">
                                                    {{ str_limit(
                                                        'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Id culpa itaque maiores corrupti doloribus voluptatibus? Necessitatibus debitis velit ducimus mollitia, eveniet, incidunt laudantium corrupti maxime magni quis non! Earum, neque?',
                                                        100,
                                                    ) }}
                                                </p>
                                                <div class="d-flex justify-content-end">
                                                    <a href="" class="btn btn-primary btn-sm mx-1"><i
                                                            class="bi bi-info-circle-fill"></i> Detail</a>
                                                    <a href="http://localhost:8000/category/beasiswa-lJxco"
                                                        class="btn btn-success btn-sm mx-1"><i
                                                            class="bi bi-play-circle-fill"></i>
                                                        Mulai</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="row align-items-center">
                    <div class="col-md-4 me-auto">
                        <h2 class="mb-4">Survey tidak tersedia</h2>
                        <p class="mb-4">Untuk saat ini belum ada survey yang ingin diisi. Silahkan akses dan coba dilain
                            waktu kembali</p>
                    </div>
                    <div class="col-md-6 aos-init aos-animate" data-aos="fade-left"> <img
                            src="{{ asset('asset/guest/img/empty.svg') }}" alt="Image" class="img-fluid"></div>
                </div>
            @endif


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
                    @if ($blogs->isNotEmpty())
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
                    @else
                        <div class="text-center">
                            <h2><i class="bi bi-plus-circle"></i></h2>
                            <h4>Blog Saat ini tidak tidak tersedia</h4>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iste odio facere sunt rem obcaecati
                                repellendus amet possimus, eius, blanditiis numquam nam veniam accusantium quas corporis
                                ducimus consequatur quos similique. Optio.</p>
                        </div>
                    @endif

                </div>
                <div class="col-md-6">
                    <span class="line">
                        <h2><span class="py-2 pe-2">Agenda</span></h2>
                    </span>
                    <p class="mt-3"><a href="" class="text-primary">Lihat semua Agenda dalam bulan ini</a></p>
                    @if ($agendas->isNotEmpty())
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
                    @else
                        <div class="text-center">
                            <h2><i class="bi bi-plus-circle"></i></h2>
                            <h4>Agenda Saat ini tidak tidak tersedia</h4>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iste odio facere sunt rem obcaecati
                                repellendus amet possimus, eius, blanditiis numquam nam veniam accusantium quas corporis
                                ducimus consequatur quos similique. Optio.</p>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </section>
    @push('scripts')
        @include('package.swipper.swipper_js')
        <script>
            $('.reviews-page-carousel').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 3
            });
        </script>
    @endpush
@endsection
