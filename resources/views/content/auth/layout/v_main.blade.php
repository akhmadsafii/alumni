<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.admin.v_head')
</head>

<body
    class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--desktop m-grid--ver-desktop m-grid--hor-tablet-and-mobile m-login m-login--6"
            id="m_login">
            <div class="m-grid__item   m-grid__item--order-tablet-and-mobile-2  m-grid m-grid--hor m-login__aside "
                style="background-image: url({{ asset('asset/img/bg-4.jpg') }});">
                <div class="m-grid__item">
                    <div class="m-login__logo">
                        <a href="#">
                            <img src="{{ asset(env('CONFIG_LOGO')) }}">
                        </a>
                    </div>
                </div>
                <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver">
                    <div class="m-grid__item m-grid__item--middle">
                        <span class="m-login__title">{{ env('CONFIG_NAME_APPLICATION') }}</span>
                        <span class="m-login__subtitle"> Aplikasi Manajemen Alumni Sekolah E-Alumni SmartSchool Adalah
                            Cara Baru Kelola Data Dan
                            Memfasilitasi Komunikasi Antar Alumni agar para alumni tetap bisa bersilaturahmi</span>
                        <a href="{{ route('first_page') }}"
                            class="btn btn-info m-btn m-btn--pill  m-btn  m-btn m-btn--icon mt-2">
                            <span>
                                <span>Kembali ke website</span>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="m-grid__item">
                    <div class="m-login__info">
                        <div class="m-login__section">
                            <a href="#" class="m-link">&copy 2018 Metronic</a>
                        </div>
                        <div class="m-login__section">
                            <a href="#" class="m-link">Privacy</a>
                            <a href="#" class="m-link">Legal</a>
                            <a href="#" class="m-link">Contact</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-grid__item m-grid__item--fluid  m-grid__item--order-tablet-and-mobile-1  m-login__wrapper">
                @yield('auth_content')
            </div>
        </div>
    </div>
    @include('layout.admin.v_foot')
    @stack('scripts_js')
    {{-- <script src="{{ asset('asset/js/login.js') }}" type="text/javascript"></script> --}}
</body>

</html>
