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

            .blog-img {
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
                <div class="col-lg-5 text-center text-lg-start">
                    <h1 class="display-4 fw-bold" data-aos="fade-right">Cek Alumni Sekarang</h1>
                    <p class="col-lg-10 mx-auto mb-5" data-aos="fade-right" data-aos-delay="100">Lorem ipsum dolor sit amet,
                        consectetur adipisicing elit.</p>
                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center justify-content-md-start">
                        <a href="#" class="btn btn-primary btn-lg px-4 gap-3" data-aos="fade-right"
                            data-aos-delay="200" data-aos-offset="-500">Cek Sekarang</a>
                    </div>
                </div>
                <div class="col-lg-7 iphone-wrap">
                    <img src="{{ asset('asset/guest/img/banner.png') }}" alt="Image" class="phone-1 img-fluid"
                        data-aos="fade-right">
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

            <div class="reviews-page-carousel owl-carousel owl-theme">
                @if ($categories > 0)
                    @foreach ($categories as $ctg)
                        <div class="item">
                            <div class="card m-1">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="align-self-center me-3 text-success">
                                            <i class="bi bi-check2-circle" style="font-size:42px;"></i>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="card-title">{{ ucfirst($ctg['name']) }}</h5>
                                            <p class="card-text">
                                                {{ Str::limit('Lorem ipsum dolor sit amet consectetur, adipisicing elit. Id culpa itaque maiores corrupti doloribus voluptatibus? Necessitatibus debitis velit ducimus mollitia, eveniet, incidunt laudantium corrupti maxime magni quis non! Earum, neque?', 100) }}
                                            </p>
                                            <div class="d-flex justify-content-end align-items-center">
                                                @if ($ctg['login'] == true && $ctg['status_terisi'] == true)
                                                    <a href="{{ route('admin.answer.detail_category', $ctg['code']) }}"
                                                        class="btn btn-primary btn-sm mx-1"><i
                                                            class="bi bi-info-circle-fill"></i> Detail</a>
                                                @else
                                                    <a href="javascript:void(0)" class="btn btn-primary btn-sm mx-1 detail"
                                                        data-id="{{ $ctg['code'] }}"><i class="bi bi-info-circle-fill"></i>
                                                        Detail</a>
                                                @endif

                                                @if ($ctg['status_terisi'] == false)
                                                    <a href="{{ route('admin.answer.category', $ctg['code']) }}"
                                                        class="btn btn-success btn-sm mx-1"><i
                                                            class="bi bi-play-circle-fill"></i> Mulai</a>
                                                @else
                                                    <div class="text-center text-success">
                                                        <span><i class="bi bi-check-circle-fill"></i> Survey telah
                                                            dijawab</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="row align-items-center">
                        <div class="col-md-4 me-auto">
                            <h2 class="mb-4">Survey tidak tersedia</h2>
                            <p class="mb-4">Untuk saat ini belum ada survey yang ingin diisi. Silahkan akses dan coba
                                dilain waktu kembali</p>
                        </div>
                        <div class="col-md-6 aos-init aos-animate" data-aos="fade-left">
                            <img src="{{ asset('asset/guest/img/empty.svg') }}" alt="Image" class="img-fluid">
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <section class="section pt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="blog">
                        <h2 class="section-title">Blog</h2>
                        <p class="mt-3"><a href="" class="text-primary">Lihat semua Berita dan Artikel</a></p>
                        <div class="blog-list">
                            @if ($blogs->isNotEmpty())
                                @foreach ($blogs as $blog)
                                    <div class="blog-item mb-4">
                                        <div class="row">
                                            <div class="col-4 col-md-5 col-lg-4">
                                                <div class="blog-img rounded"
                                                    style="background-image: url('{{ $blog['file'] != null ? asset($blog['file']) : asset('asset/img/no_image.jpeg') }}')">
                                                </div>
                                            </div>
                                            <div class="col-8 col-md-7 col-lg-8">
                                                <div class="blog-content">
                                                    <a href="{{ route('blog.detail', $blog['code']) }}">
                                                        <h5 class="blog-title">{{ $blog['title'] }}</h5>
                                                    </a>
                                                    <p class="blog-date">{{ $blog['created_at']->diffForHumans() }}</p>
                                                    <p class="blog-text">{!! Str::limit($blog['content'], 200) !!}</p>
                                                    <a href="{{ route('blog.detail', $blog['code']) }}" class="blog-link">Read More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center">
                                    <h2><i class="bi bi-plus-circle"></i></h2>
                                    <h4>Blog Saat ini tidak tidak tersedia</h4>
                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iste odio facere sunt rem obcaecati repellendus amet possimus, eius, blanditiis numquam nam veniam accusantium quas corporis ducimus consequatur quos similique. Optio.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h2 class="mb-0">Agenda</h2>
                            <a href="#" class="text-primary">Lihat semua Agenda dalam bulan ini</a>
                        </div>
                        <div class="card-body">
                            @if ($agendas->isNotEmpty())
                                @foreach ($agendas as $agenda)
                                    <div class="media mb-3">
                                        <div class="img-fluid rounded-start me-3 img-agenda"
                                            style="background-image: url('{{ $agenda['file'] != null ? asset($agenda['file']) : asset('asset/img/no_image.jpeg') }}')">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="card-title">{{ $agenda['title'] }}</h5>
                                            <p class="card-text mb-0">{{ Str::limit($agenda['description'], 80) }}</p>
                                            <small class="text-muted">Waktu: {{ DateHelper::getTanggal($agenda['start_date']) }}</small>
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
            </div>

        </div>
    </section>
    @push('modals')
        <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Survey</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-6 col-form-label">Jenis</label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control-plaintext" id="name"
                                    value="email@example.com">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-6 col-form-label">Total Pertanyaan</label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control-plaintext" id="amount_total"
                                    value="email@example.com">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-6 col-form-label">Inputan Teks</label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control-plaintext" id="amount_teks"
                                    value="email@example.com">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-6 col-form-label">Pilihan</label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control-plaintext" id="amount_options"
                                    value="email@example.com">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endpush
    @push('scripts')
        @include('package.swipper.swipper_js')
        <script>
            $('.reviews-page-carousel').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 3
            });

            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $(document).on('click', '.detail', function() {
                    let code = $(this).data('id');
                    $.ajax({
                        url: "{{ route('detail_category') }}",
                        data: {
                            code
                        },
                        success: function(data) {
                            $('#name').val(data.name);
                            $('#amount_total').val(data.total_question);
                            $('#amount_options').val(data.total_option);
                            $('#amount_teks').val(data.total_essay);
                            $('#modalDetail').modal('show');
                        }
                    });
                });
            })
        </script>
    @endpush
@endsection
