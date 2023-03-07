@extends('layout.guest.v_main')
@section('content')
    @push('styles')
        <style>
            .custom-search-botton {
                right: 3px;
                top: 3px;
                bottom: 3px;
                line-height: 1 !important;
                z-index: 7 !important;
            }

            .img-blog {
                background-position: center center;
                background-repeat: no-repeat;
                width: 100%;
                height: 235px;
                transition: background ease-out 200ms;
                border-radius: 5px;
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
                            <h1 data-aos="fade-up" data-aos-delay="" class="aos-init aos-animate">Blog</h1>
                            <p class="mb-5 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">Semua informasi
                                dari alumni tentang data diri dan kelulusan disajikan disini</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section pt-3">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-8 mx-auto">
                    <form action="">
                        <div class="input-group custom-search position-relative">
                            <input type="text" class="form-control custom-search-input w-100" id="search" name="search"
                            @isset($sort_search) value="{{ $sort_search }}" @endisset
                                placeholder="Masukan Pencarian">
                            <button class="btn btn-primary custom-search-botton position-absolute"
                                type="submit">Cari</button>
                        </div>
                    </form>
                </div>

            </div>
            <div class="row mb-5">
                @foreach ($blogs as $blog)
                    <div class="col-md-4">
                        <div class="post-entry">
                            <a href="{{ route('blog.detail', $blog['code']) }}" class="d-block mb-4">
                                <div class="img-blog" style="background-image: url('{{ $blog['file'] }}')">
                                </div>
                            </a>
                            <div class="post-text"> <span class="post-meta">{{ $blog['created_at'] }} • By <a
                                        href="#">{{ $blog['user'] }}</a></span>
                                <h3><a href="{{ route('blog.detail', $blog['code']) }}">{{ $blog['title'] }}</a></h3>
                                <p>{!! Str::limit($blog['content'], 200) !!}</p>
                                @if (strlen($blog['content']) > 200)
                                    <p><a href="{{ route('blog.detail', $blog['code']) }}" class="readmore">Read more</a>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    {!! $blogs->render() !!}
                </div>
            </div>
        </div>
    </section>
@endsection
