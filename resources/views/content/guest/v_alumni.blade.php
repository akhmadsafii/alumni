@extends('layout.guest.v_main')
@section('content')
    @push('styles')
        <style>
            .hero-section {
                height: auto !important;
            }

            .container.p-5.bg-light {
                margin-top: 120px;
            }

            @media only screen and (max-width: 480px) {
                .container.p-5.bg-light {
                    margin-top: 85px !important;
                    width: auto !important;
                    margin: 0 10px;
                    padding: 10px !important;
                }
            }

            .custom-search {
                position: relative;
            }

            .custom-search-input {
                width: 100% !important;
                padding-right: 100px !important;
                box-sizing: border-box;
            }

            .custom-search-botton {
                position: absolute !important;
                right: 3px;
                top: 3px;
                bottom: 3px;
                line-height: 1 !important;
                z-index: 7 !important;
            }

            .banner {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 125px;
                background-position: center;
                background-size: cover;
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
        <div class="container h-80">
            <div class="row align-items-center h-100">
                <div class="col-8 mx-auto">
                    <div class="jumbotron text-white">
                        <center>
                            <h3 class="text-white">Daftar Alumni</h3>
                            <p>Semua informasi dari alumni tentang data diri dan kelulusan disajikan disini</p>
                        </center>
                        <form action="" method="post">
                            <div class="input-group custom-search">
                                <input type="text" class="form-control custom-search-input"
                                    placeholder="Masukan Pencarian">
                                <button class="btn btn-primary custom-search-botton" type="submit">Cari</button>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="my-3">
                                        <label for="">Jurusan</label>
                                        <select name="id_major" id="id_major" class="form-control">
                                            <option value="">Pilih Jurusan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="my-3">
                                        <label for="">Angkatan</label>
                                        <select name="id_major" id="id_major" class="form-control">
                                            <option value="">Pilih Jurusan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </section>
    <div class="container" style="top: -100px !important;">
        <div class="col-md-10 col-12 mx-auto">
            <div class="row">
                <div class="col-md-4 col-6">
                    <div
                        class="profile-card card rounded-lg shadow p-4 p-xl-5 mb-4 text-center position-relative overflow-hidden">
                        <div class="banner" style="background-image: url({{ asset('asset/img/bg-1.png') }});"></div>
                        <h4 class="mb-4">Tukang Jamu</h4>
                        <img src="{{ asset('asset/img/user4.jpg') }}" alt="" class="rounded-circle mx-auto mb-3">
                        <div class="text-center mb-4">
                            <p class="mb-2 text-muted">Paijo</p>
                            <p class="mb-2 text-muted">132343</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div
                        class="profile-card card rounded-lg shadow p-4 p-xl-5 mb-4 text-center position-relative overflow-hidden">
                        <div class="banner" style="background-image: url({{ asset('asset/img/bg-1.png') }});"></div>
                        <h4 class="mb-4">Tukang Jamu</h4>
                        <img src="{{ asset('asset/img/user4.jpg') }}" alt="" class="rounded-circle mx-auto mb-3">
                        <div class="text-center mb-4">
                            <p class="mb-2 text-muted">Paijo</p>
                            <p class="mb-2 text-muted">132343</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div
                        class="profile-card card rounded-lg shadow p-4 p-xl-5 mb-4 text-center position-relative overflow-hidden">
                        <div class="banner" style="background-image: url({{ asset('asset/img/bg-1.png') }});"></div>
                        <h4 class="mb-4">Tukang Jamu</h4>
                        <img src="{{ asset('asset/img/user4.jpg') }}" alt="" class="rounded-circle mx-auto mb-3">
                        <div class="text-center mb-4">
                            <p class="mb-2 text-muted">Paijo</p>
                            <p class="mb-2 text-muted">132343</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div
                        class="profile-card card rounded-lg shadow p-4 p-xl-5 mb-4 text-center position-relative overflow-hidden">
                        <div class="banner" style="background-image: url({{ asset('asset/img/bg-1.png') }});"></div>
                        <h4 class="mb-4">Tukang Jamu</h4>
                        <img src="{{ asset('asset/img/user4.jpg') }}" alt="" class="rounded-circle mx-auto mb-3">
                        <div class="text-center mb-4">
                            <p class="mb-2 text-muted">Paijo</p>
                            <p class="mb-2 text-muted">132343</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
