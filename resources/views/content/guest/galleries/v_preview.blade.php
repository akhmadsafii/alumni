@extends('layout.guest.v_main')
@section('content')
    @push('styles')
        <style>
           
        </style>
    @endpush
    <div class="container-fluid position-relative">
        <div class="main-content p-5 bg-transparent rounded" style="">
            <div class="bg-transparent">
                <div class="text-center">
                    <h2 class="mt-3 text-white">Galeri</h2>
                    <p class="mt-3 text-white">Abadikan moment tebaikmu bersama teman disini
                    </p>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-7">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" aria-label="Text input with dropdown button">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false" style="padding: 13px 30px !important;">Dropdown</button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Separated link</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
               
            </div>
        </div>
    </div>
@endsection
