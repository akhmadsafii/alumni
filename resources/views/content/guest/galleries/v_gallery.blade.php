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

            /* .my-card {
                                                                                position: absolute;
                                                                                top: -20px;
                                                                            } */

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



            /* DEMO GENERAL ============================== */
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


            /* DEMO 1 ============================== */
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
                    <h2 class="mt-3 text-white">Galeri</h2>
                    <p class="mt-3 text-white">Abadikan moment tebaikmu bersama teman disini
                    </p>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-7">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" aria-label="Text input with dropdown button">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false" style="padding: 13px 30px !important;">Dropdown</button>
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
                        <div class="hover hover-1 text-white rounded"><img
                                src="https://bootstrapious.com/i/snippets/sn-img-hover/hoverSet-3.jpg" alt="">
                            <div class="hover-overlay"></div>
                            <div class="hover-1-content px-5 pt-4">
                                <h3 class="hover-1-title text-uppercase font-weight-bold mb-0"> <span
                                        class="font-weight-light">Image </span>Caption</h3>
                                <p class="hover-1-description font-weight-light mb-0">Lorem ipsum dolor sit amet,
                                    consectetur adipisicing elit.</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center my-2">
                            <div class="d-flex justify-content-start align-items-center">
                                <a href="#!">
                                    <img src="{{ $avatar }}" alt="avatar" class="img-fluid rounded-circle me-3"
                                        width="35">
                                </a>
                                <p class="my-0"><strong>{{ $user }}</strong></p>
                            </div>
                            <span>
                                <i class="bi bi-eye-fill"></i> 200
                            </span>
                        </div>
                    </div>
                    {{-- <div class="col-lg-3 col-md-4 col-6">
                        <a href="{{ route('gallery.detail', $gallery->code) }}">
                            <div class="card">
                                <img class="img-fluid rounded w-100" src="{{ $image }}" alt="">
                                <div class="d-flex justify-content-between align-items-center mx-3 my-2">
                                    <div class="d-flex justify-content-start align-items-center">
                                        <a href="#!">
                                            <img src="{{ $avatar }}" alt="avatar"
                                                class="img-fluid rounded-circle me-3" width="35">
                                        </a>
                                        <p class="my-0"><strong>{{ $user }}</strong></p>
                                    </div>
                                    <span>
                                        <i class="bi bi-eye-fill"></i> 200
                                    </span>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $gallery->name }}</h5>
                                    <p class="card-text">{!! Str::limit($gallery->description, 100) !!}</p>
                                </div>
                            </div>
                        </a>
                    </div> --}}
                @endforeach
            </div>
        </div>
    </div>
@endsection
