@extends('layout.guest.v_main')
@section('content')
    @push('styles')
        <style>
            .hover {
                overflow: hidden;
                position: relative;
                padding-bottom: 60%;
            }

            .hover-overlay {
                width: 100%;
                height: 100%;
                position: absolute;
                top: 0;
                left: 0;
                z-index: 90;
                transition: all 0.4s;
            }

            .hover img {
                width: 100%;
                position: absolute;
                top: 0;
                left: 0;
                transition: all 0.3s;
            }

            .hover-content {
                position: relative;
                z-index: 99;
            }

            .hover-1 img {
                width: 105%;
                position: absolute;
                top: 0;
                left: -5%;
                transition: all 0.3s;
            }

            .hover-1-content {
                position: absolute;
                bottom: 0;
                left: 0;
                z-index: 99;
                transition: all 0.4s;
            }

            .hover-1 .hover-overlay {
                background: rgba(0, 0, 0, 0.5);
            }

            .hover-1-description {
                transform: translateY(0.5rem);
                transition: all 0.4s;
                opacity: 0;
            }

            .hover-1:hover .hover-1-content {
                bottom: 2rem;
            }

            .hover-1:hover .hover-1-description {
                opacity: 1;
                transform: none;
            }

            .hover-1:hover img {
                left: 0;
            }

            .hover-1:hover .hover-overlay {
                opacity: 0;
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
                            <h1 data-aos="fade-up" data-aos-delay="" class="aos-init aos-animate">Galleri</h1>
                            <p class="mb-5 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">Abadikan moment
                                terbaikmu bersama teman disini.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section pt-3">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-7">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" aria-label="Text input with dropdown button">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false" style="padding: 12px 30px !important;">Dropdown</button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Separated link</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($galleries as $gallery)
                    @php
                        if ($gallery->role == 'admin') {
                            $user = $gallery->name_admin;
                            $avatar = $gallery->file_admin ? asset($gallery->file_admin) : asset('asset/img/user4.jpg');
                        } else {
                            $user = $gallery->name_user;
                            $avatar = $gallery->file_user ? asset($gallery->file_user) : asset('asset/img/user4.jpg');
                        }

                        $image = json_decode($gallery->file);
                        $image = asset(reset($image));
                    @endphp
                    <div class="col-lg-3 col-md-4 col-6">
                        <a href="{{ route('gallery.detail', $gallery->code) }}">
                            <div class="hover hover-1 text-white rounded"><img src="{{ $image }}" alt="">
                                <div class="hover-overlay"></div>
                                <div class="hover-1-content px-5 pt-4">
                                    <h3 class="hover-1-title text-uppercase font-weight-bold mb-0 text-light">
                                        {{ $gallery->name }}</h3>
                                    <p class="hover-1-description font-weight-light mb-0">{!! Str::limit($gallery->description, 100) !!}</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center my-2">
                                <div class="d-flex justify-content-start align-items-center">
                                    <img src="{{ $avatar }}" alt="avatar" class="img-fluid rounded-circle me-3"
                                        width="35">
                                    <p class="my-0"><strong>{{ $user }}</strong></p>
                                </div>
                                <span>
                                    <i class="bi bi-eye-fill"></i> 200
                                </span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
