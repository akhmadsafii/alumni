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
        <div class="row">
            <div class="col-xl-4 col-sm-4 col-6">
                <div class="card bg-primary text-white m-portlet">
                    <div class="card-body d-flex">
                        <div class="mx-auto">
                            <i class="la la-users fa-4x"></i>
                        </div>
                        <div class="description">
                            <h5 class="card-title">Total Alumni</h5>
                            <p class="card-text">120 Alumni</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-4 col-6">
                <div class="card bg-danger text-white m-portlet">
                    <div class="card-body d-flex">
                        <div class="mx-auto">
                            <i class="la la-venus fa-4x"></i>
                        </div>
                        <div class="description">
                            <h5 class="card-title">Alumni Perempuan</h5>
                            <p class="card-text">80 Alumni</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-4 col-6">
                <div class="card bg-success text-white m-portlet">
                    <div class="card-body d-flex">
                        <div class="mx-auto">
                            <i class="la la-mars fa-4x"></i>
                        </div>
                        <div class="description">
                            <h5 class="card-title">Total Laki-laki</h5>
                            <p class="card-text">40 Alumni</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="card-title mb-0">Jumlah Survey</h5>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chart-pie fa-2x text-primary"></i>
                            </div>
                        </div>
                        <div class="mt-4 mb-0">
                            <div class="text-muted small">Total Survey</div>
                            <span class="h5 font-weight-bold mb-0">120</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="card-title mb-0">Partisipan Survey</h5>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-success"></i>
                            </div>
                        </div>
                        <div class="mt-4 mb-0">
                            <div class="text-muted small">Jumlah Partisipan</div>
                            <span class="h5 font-weight-bold mb-0">100</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Statistik pekerjaan Alumni</h5>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Partisipan Survey</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Angkatan</th>
                                    <th>Jumlah Siswa</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Siswa Per Angkatan</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Angkatan</th>
                                    <th>Jumlah Siswa</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
