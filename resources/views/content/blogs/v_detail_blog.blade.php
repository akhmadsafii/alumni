@extends('layout.admin.v_main')
@section('content')
    @push('styles')
        <style>
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
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{ session('title') }}</h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="#" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text">User</span>
                        </a>
                    </li>
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text">{{ session('title') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="row">
            <div class="col-md-8">
                <div class="m-portlet">
                    <div class="m-portlet__body p-3">
                        <div class="m-widget5 mb-2">
                            <div class="m-widget5__item mb-0 pb-0">
                                <div class="m-widget5__content w-100">
                                    <div class="m-widget5__pic">
                                        <img class="m-widget7__img rounded" src="{{ asset($blog['file']) }}" alt=""
                                            style="width: 300px !important">
                                    </div>

                                    <div class="m-widget5__section w-100">

                                        <h4 class="m-widget5__title">
                                            {{ $blog['title'] }}
                                        </h4>
                                        <p>19 Jan 2022</p>
                                        <div class="m-widget3">
                                            <div class="m-widget3__item mb-0">
                                                <div class="m-widget3__header">
                                                    <div class="m-widget3__user-img mb-0">
                                                        <img class="m-widget3__img"
                                                            src="{{ $user['file'] != null ? asset($user['file']) : asset('asset/img/user4.jpg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="m-widget3__info">
                                                        <span class="m-widget3__username">
                                                            {{ $user['name'] }}
                                                        </span><br>
                                                        <span class="m-widget3__time">
                                                            {{ $blog['role'] }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between my-2">
                            <span class="m-badge m-badge--success m-badge--wide">pending</span>
                            <span>
                                30 <i class="la la-eye"></i>
                            </span>
                        </div>
                        <hr>
                        {!! $blog['content'] !!}

                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <div
                    class="profile-card card rounded-lg shadow p-4 p-xl-5 mb-4 text-center position-relative overflow-hidden">
                    <div class="banner" style="background-image: url({{ asset('asset/img/bg-1.png') }});"></div>
                    <h4 class="mb-4">Published By</h4>
                    <img src="{{ $user['file'] != null ? asset($user['file']) : asset('asset/img/user4.jpg') }}"
                        alt="" class="m--img-rounded mx-auto mb-3">
                    <div class="text-center mb-4">
                        <h5>{{ $user['name'] }}</h5>
                        <p class="mb-2">{{ $blog['role'] }}</p>
                    </div>
                </div>
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Blog {{ $user['name'] }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        @foreach ($blogs as $blgs)
                            <div class="m-widget3">
                                <div class="m-widget3__item my-3">
                                    <div class="m-widget3__header">
                                        <div class="m-widget3__user-img">
                                            <img class="m-widget3__img rounded my-2" src="{{ $blgs['file'] != null ? asset($blgs['file']) : 'https://via.placeholder.com/150' }}"
                                                alt="">
                                        </div>
                                        <div class="m-widget3__info">
                                            <span class="m-widget3__username">
                                                {{ $blgs['title'] }}
                                            </span><br>
                                            <span class="m-widget3__time">
                                                <span class="m-badge m-badge--success m-badge--wide">Diterima</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>

    @push('scripts')
        @include('package.summernote.summernote_js')
        @include('component.formImageSubmit')
        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                $('body').on('submit', '#formSubmit', function(e) {
                    e.preventDefault();
                    $('#btnSubmit').addClass('m-loader m-loader--light m-loader--right');
                    $('#btnSubmit').attr("disabled", true);
                    var formData = new FormData(this);
                    $.ajax({
                        type: "POST",
                        url: '{{ route('admin.blog.store') }}',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            toastr.success(data.message, "Berhasil");
                            window.location.href = "{{ route('admin.blog.page') }}"
                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            toastr.error(res.message, "GAGAL");
                            $('#btnSubmit').removeClass('m-loader m-loader--light m-loader--right');
                            $('#btnSubmit').attr("disabled", false);
                        }
                    });
                });

            })

            function readURL(input, id) {
                id = id || '#preview-image';
                if (input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(id).attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endpush
@endsection
