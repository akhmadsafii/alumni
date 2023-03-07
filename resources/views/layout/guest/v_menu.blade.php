<div class="container d-flex justify-content-between align-items-center">

    <div class="logo">
        <h1 style="margin-top: revert !important;"><a href="index.html">Alumni</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>
    </div>

    <nav id="navbar" class="navbar">
        <ul>
            <li><a class="active" href="{{ route('first_page') }}">Beranda</a></li>
            <li><a href="{{ route('discussion') }}">Diskusi</a></li>
            <li><a href="{{ route('alumni') }}">Alumni</a></li>
            <li><a href="{{ route('agenda', ['appear' => 'all']) }}">Agenda</a></li>
            <li><a href="{{ route('survey.category') }}">Survey</a></li>
            <li><a href="{{ route('blog.public') }}">Blog</a></li>
            <li><a href="{{ route('gallery.public') }}">Galeri</a></li>
            @if (Auth::guard('user')->check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="bi bi-person-circle me-1"></i>
                        <strong>{{ Auth::guard('user')->user()->name }}</strong>
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul class="dropdown-menu px-2"
                        style="width: max-content; right: 0 !important; left: auto !important">
                        <li>
                            <div class="navbar-login">
                                <div class="row">
                                    <div class="col-lg-4 m-auto">
                                        <center>
                                            <img src="{{ asset('asset/img/user4.jpg') }}" alt="" width="50"
                                                class="rounded">
                                        </center>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="text-left my-0">
                                            <strong>{{ Auth::guard('user')->user()->name }}</strong>
                                        </p>
                                        <p class="text-left small">{{ Auth::guard('user')->user()->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <hr>
                        <li>
                            <div class="d-flex justify-content-around">
                                <a href="" class="btn btn-info btn-sm text-white"
                                    style="padding: 9px 20px !important">Profile</a>
                                <a href="{{ route('auth.logout') }}" class="btn btn-danger btn-sm text-white"
                                    style="padding: 9px 20px !important">Logout</a>
                            </div>
                        </li>
                    </ul>
                </li>
            @else
                <li><a href="{{ route('auth.login') }}"
                        class="btn btn-outline-secondary btn-sm border border-light ms-2 me-1"
                        style="padding: 9px 28px !important;">Login</a></li>
            @endif
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
    </nav>

</div>
