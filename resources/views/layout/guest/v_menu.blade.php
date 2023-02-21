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
            <li><a href="{{ route('agenda') }}">Agenda</a></li>
            <li><a href="{{ route('survey.category') }}">Survey</a></li>
            <li><a href="{{ route('public.blog') }}">Blog</a></li>
            <li><a href="contact.html">Galeri</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

</div>
