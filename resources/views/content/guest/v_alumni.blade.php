@extends('layout.guest.v_main')
@section('content')
    @push('styles')
        <style>
            .search-form {
                background-color: #f5f5f5;
                border-radius: 25px;
                padding: 20px;
            }

            .search-input {
                border: none;
                border-radius: 25px;
                padding: 10px;
                font-size: 16px;
                background-color: transparent;
                color: #555;
            }

            .search-input:focus {
                outline: none;
            }

            .search-button {
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 25px;
                padding: 10px 20px;
                margin-left: -40px;
                transition: 0.3s;
            }

            .search-button:hover {
                transform: translateX(5px);
            }

            .form-group {
                margin-bottom: 1rem;
            }

            .form-control {
                border: none;
                border-radius: 25px;
                background-color: #fff;
                padding: 10px;
                font-size: 16px;
                color: #555;
            }

            .form-control:focus {
                outline: none;
                box-shadow: none;
            }

            .select2-container--default .select2-selection--single .select2-selection__rendered {
                color: #555;
            }

            .select2-container--default .select2-selection--single {
                border: none;
                border-radius: 25px;
                background-color: #fff;
                padding: 10px;
            }

            .select2-container--default .select2-selection--single:focus {
                outline: none;
                box-shadow: none;
            }


            .banner {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 85px;
                background-position: center;
                background-size: cover;
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
                            <h1 data-aos="fade-up" data-aos-delay="" class="aos-init aos-animate">Daftar Alumni</h1>
                            <p class="mb-5 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">Semua informasi
                                dari alumni tentang data diri dan kelulusan disajikan disini</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section pt-2">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <form action="" class="search-form">
                        <div class="input-group">
                            <input type="text" class="form-control search-input"
                                placeholder="Masukkan kata kunci pencarian"
                                @isset($sort_search) value="{{ $sort_search }}" @endisset name="search"
                                required>
                            <button class="btn search-button" type="submit"><i class="bi bi-search"></i></button>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_major">Jurusan</label>
                                    <select name="major" id="id_major" class="form-control">
                                        <option value="" selected disabled>Pilih Jurusan</option>
                                        @foreach ($majors as $major)
                                            <option value="{{ $major['code'] }}">{{ $major['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="graduating_class">Angkatan</label>
                                    <select name="graduating_class" id="graduating_class" class="form-control">
                                        <option value="" selected disabled>-- Pilih Angkatan --</option>
                                        @foreach ($graduating_class as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div class="container" style="top: -100px !important;">
        <div class="col-md-10 col-12 mx-auto">
            <div class="row">
                @if ($users->isNotEmpty())
                    @foreach ($users as $user)
                        <div class="col-md-3 col-6">
                            <div
                                class="profile-card card rounded-lg shadow p-4 p-xl-5 mb-4 text-center position-relative overflow-hidden">
                                <div class="banner" style="background-image: url({{ asset('asset/img/bg-1.png') }});"></div>
                                <img src="{{ $user['file'] }}" alt="" class="rounded-circle mx-auto mb-3">
                                <h5 class="mb-2">{{ $user['name'] }}</h5>
                                <small class="text-muted">{{ $user['major'] }}</small>
                                <p class="mt-3">{{ $user['graduating_class'] }}</p>
                                <p class="text-muted mb-0">Lulus Tahun {{ $user['graduation_year'] }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12">
                        <div class="row align-items-center">
                            <div class="col-md-4 me-auto">
                                <h2 class="mb-4">Alumni tidak tersedia</h2>
                                <p class="mb-4">Untuk saat ini belum ada alumni yang tersedia. Silahkan akses dan coba
                                    dilain waktu kembali</p>
                            </div>
                            <div class="col-md-6 aos-init aos-animate" data-aos="fade-left">
                                <img src="{{ asset('asset/guest/img/empty.svg') }}" alt="Image" class="img-fluid">
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-12">
                    <div class="d-flex justify-content-center mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
