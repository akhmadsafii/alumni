@extends('layout.guest.v_main')
@section('content')
    @push('styles')
        @include('package.swipper.swipper_css')
        <style>
            #header {
                background: rgba(39, 70, 133, 0.8);
            }

            .slick-track {
                display: flex !important;
            }

            .slider .slick-slide {
                padding: 10px;
            }

            .slick-active {
                height: inherit !important;
            }

            .slider .slick-slide img {
                width: 100%;
                border-radius: 12px
            }
        </style>
    @endpush
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center my-2">
                        <div class="d-flex justify-content-start align-items-center">
                            @php
                                if ($gallery['role'] == 'admin') {
                                    $avatar = $gallery['file_admin'] ? asset($gallery['file_admin']) : asset('asset/img/user4.jpg');
                                    $user = $gallery['name_admin'];
                                } else {
                                    $avatar = $gallery['file_user'] ? asset($gallery['file_user']) : asset('asset/img/user4.jpg');
                                    $user = $gallery['name_user'];
                                }
                            @endphp
                            <img src="{{ $avatar }}" alt="avatar" class="img-fluid rounded-circle me-3" width="50">
                            <ul class="list-unstyled my-0">
                                <li>
                                    <h3><a href="#">{{ $gallery['name'] }}</a></h3>
                                    <span>Post by : {{ $user }}</span>
                                </li>

                            </ul>
                        </div>
                        <span>
                            {{ DateHelper::getTanggal($gallery['created_at']) }}
                        </span>
                    </div>
                </div>
                <div class="col-md-12">
                    @php
                        $img_decode = json_decode($gallery['file']);
                    @endphp
                    <div class="main">
                        <div class="slider slider-for">
                            @foreach ($img_decode as $img_slider)
                                <div>
                                    <a href="{{ route('gallery.preview', encrypt($img_slider)) }}" target="_blank"><img
                                            src="{{ asset($img_slider) }}" alt=""></a>
                                </div>
                            @endforeach
                        </div>
                        <div class="slider slider-nav">
                            @foreach ($img_decode as $img_slider_nav)
                                <div>
                                    <img src="{{ asset($img_slider_nav) }}" alt="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <p>{!! $gallery['description'] !!}</p>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        @include('package.swipper.swipper_js')
        <script>
            $('.slider-for').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                asNavFor: '.slider-nav'
            });
            $('.slider-nav').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                asNavFor: '.slider-for',
                dots: true,
                focusOnSelect: true
            });

            $('a[data-slide]').click(function(e) {
                e.preventDefault();
                var slideno = $(this).data('slide');
                $('.slider-nav').slick('slickGoTo', slideno - 1);
            });
        </script>
    @endpush
@endsection
