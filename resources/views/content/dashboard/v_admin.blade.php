@extends('layout.admin.v_main')
@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Inner Page</h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="#" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text">Resources</span>
                        </a>
                    </li>
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text">Timesheet</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="text-center mb-3">
            <h2>Selamat Datang di Aplikasi E Surat</h2>
            <div>Aplikasi ini memudahkan dalam pengolahan surat dan disposisi</div>
        </div>
        <div class="m-portlet m-portlet--bordered-semi m-portlet--space m-portlet--full-height ">
            <div class="m-portlet__body">
                <div class="row">
                    <div class="col-xl-2 col-sm-4 col-6">
                        <div class="card my-1">
                            <div class="card-body">
                                <center>
                                    <h3 class="primary"><i class="flaticon-feed fa-3x"></i></h3>
                                    <span>Surat Masuk</span>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-4 col-6">
                        <div class="card my-1">
                            <div class="card-body">
                                <center>
                                    <h3 class="primary"><i class="flaticon-mail fa-3x"></i></h3>
                                    <span>Surat Keluar</span>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-4 col-6">
                        <div class="card my-1">
                            <div class="card-body">
                                <center>
                                    <h3 class="primary"><i class="flaticon-list fa-3x"></i></h3>
                                    <span>Draft</span>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-4 col-6">
                        <div class="card my-1">
                            <div class="card-body">
                                <center>
                                    <h3 class="primary"><i class="flaticon-file-1 fa-3x"></i></h3>
                                    <span>Buat Pesan</span>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-4 col-6">
                        <div class="card my-1">
                            <div class="card-body">
                                <center>
                                    <h3 class="primary"><i class="flaticon-folder-2 fa-3x"></i></h3>
                                    <span>Disposisi Masuk</span>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-4 col-6">
                        <div class="card my-1">
                            <div class="card-body">
                                <center>
                                    <h3 class="primary"><i class="flaticon-folder-3 fa-3x"></i></h3>
                                    <span>Disposisi Keluar</span>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-sm-4 col-6">
                <div class="card my-1">
                    <div class="card-body d-flex">
                        <div class="mx-auto">
                            <i class="la la-users fa-4x"></i>
                        </div>
                        <div class="description">
                            <h5 class="card-title">Total Alumni</h5>
                            120 Alumni
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-4 col-6">
                <div class="card my-1">
                    <div class="card-body d-flex">
                        <div class="mx-auto">
                            <i class="la la-venus fa-4x"></i>
                        </div>
                        <div class="description">
                            <h5 class="card-title">Alumni Perempuan</h5>
                            120 Alumni
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-4 col-6">
                <div class="card my-1">
                    <div class="card-body d-flex">
                        <div class="mx-auto">
                            <i class="la la-mars fa-4x"></i>
                        </div>
                        <div class="description">
                            <h5 class="card-title">Total Laki-laki</h5>
                            120 Alumni
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
