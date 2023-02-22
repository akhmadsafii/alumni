@extends('layout.guest.v_main')
@section('content')
    @push('styles')
        <style>
            .container-fluid {
                z-index: 3;
            }

            .main-content {
                margin-top: -700px;
            }

            .my-card {
                position: absolute;
                top: -20px;
            }

            @media only screen and (max-width: 480px) {
                .container.p-5.bg-light {
                    margin-top: 85px !important;
                    width: auto !important;
                    margin: 0 10px;
                    padding: 10px !important;
                }

                .main-content {
                    margin-top: -880px !important;
                }
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
    </section>
    <div class="container-fluid position-relative">
        <div class="main-content p-5 bg-transparent rounded" style="">
            <div class="bg-transparent">
                <div class="text-center">
                    <h2 class="mt-3 text-white">Survey</h2>
                    <p class="mt-3 text-white">pelacakan jejak lulusan/alumni yang dilakukan kepada alumni 2 tahun setelah
                        lulus . Survey bertujuan untuk mengetahui outcomependidikan dalam bentuk transisi dari dunia
                        pendidikan tinggi ke dunia kerja
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
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
                                                        <a href="{{ route('survey.survey', $category['code']) }}" class="btn btn-success btn-sm mx-1"><i
                                                                class="bi bi-play-circle-fill"></i> Mulai</a>
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
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
