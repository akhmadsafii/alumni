@extends('layout.guest.v_main')
@section('content')
    @push('styles')
        <style>
            .container-fluid {
                z-index: 3;
            }

            .main-content {
                margin-top: -700px;
            }

            .my-card {
                position: absolute;
                top: -20px;
            }


            .main-title {
                color: #2d2d2d;
                text-align: center;
                text-transform: capitalize;
                padding: 0.7em 0;
            }

            .container {
                padding: 1em 0;
                float: left;
                width: 50%;
            }

            @media screen and (max-width: 640px) {
                .container {
                    display: block;
                    width: 100%;
                }
            }

            @media screen and (min-width: 900px) {
                .container {
                    width: 33.33333%;
                }
            }

            .container .title {
                color: #1a1a1a;
                text-align: center;
                margin-bottom: 10px;
            }

            .content {
                position: relative;
                width: 90%;
                max-width: 400px;
                margin: auto;
                overflow: hidden;
            }

            .content .content-overlay {
                background: rgba(0, 0, 0, 0.7);
                position: absolute;
                height: 99%;
                width: 100%;
                left: 0;
                top: 0;
                bottom: 0;
                right: 0;
                opacity: 0;
                -webkit-transition: all 0.4s ease-in-out 0s;
                -moz-transition: all 0.4s ease-in-out 0s;
                transition: all 0.4s ease-in-out 0s;
            }

            .content:hover .content-overlay {
                opacity: 1;
            }

            .content-image {
                width: 100%;
            }

            .content-details {
                position: absolute;
                text-align: center;
                padding-left: 1em;
                padding-right: 1em;
                width: 100%;
                top: 50%;
                left: 50%;
                opacity: 0;
                -webkit-transform: translate(-50%, -50%);
                -moz-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
                -webkit-transition: all 0.3s ease-in-out 0s;
                -moz-transition: all 0.3s ease-in-out 0s;
                transition: all 0.3s ease-in-out 0s;
            }

            .content:hover .content-details {
                top: 50%;
                left: 50%;
                opacity: 1;
            }

            .content-details h3 {
                color: #fff;
                font-weight: 500;
                letter-spacing: 0.15em;
                margin-bottom: 0.5em;
                text-transform: uppercase;
            }

            .content-details p {
                color: #fff;
                font-size: 0.8em;
            }

            .fadeIn-bottom {
                top: 80%;
            }

            .fadeIn-top {
                top: 20%;
            }

            .fadeIn-left {
                left: 20%;
            }

            .fadeIn-right {
                left: 80%;
            }

            @media only screen and (max-width: 480px) {
                .container.p-5.bg-light {
                    margin-top: 85px !important;
                    width: auto !important;
                    margin: 0 10px;
                    padding: 10px !important;
                }

                .main-content {
                    margin-top: -880px !important;
                }
            }
        </style>
    @endpush
    <section class="hero-section" id="hero">
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
    </section>
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
                <div class="col-md-12">
                    <div class="container">
                        <h3 class="title">Text fadeIn bottom</h3>
                        <div class="content">
                            <a href="https://unsplash.com/photos/HkTMcmlMOUQ" target="_blank">
                                <div class="content-overlay"></div>
                                <img class="content-image" src="https://source.unsplash.com/HkTMcmlMOUQ" alt="">
                                <div class="content-details fadeIn-bottom">
                                    <h3 class="content-title">This is a title</h3>
                                    <p class="content-text">This is a short description</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="container">
                        <h3 class="title">Text fadeIn top</h3>
                        <div class="content">
                            <a href="https://unsplash.com/photos/HkTMcmlMOUQ" target="_blank">
                                <div class="content-overlay"></div>
                                <img class="content-image" src="https://source.unsplash.com/HkTMcmlMOUQ" alt="">
                                <div class="content-details fadeIn-top">
                                    <h3>This is a title</h3>
                                    <p>This is a short description</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="container">
                        <h3 class="title">Text fadeIn left</h3>
                        <div class="content">
                            <a href="https://unsplash.com/photos/HkTMcmlMOUQ" target="_blank">
                                <div class="content-overlay"></div>
                                <img class="content-image" src="https://source.unsplash.com/HkTMcmlMOUQ" alt="">
                                <div class="content-details fadeIn-left">
                                    <h3>This is a title</h3>
                                    <p>This is a short description</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="container">
                        <h3 class="title">Text fadeIn right</h3>
                        <div class="content">
                            <a href="https://unsplash.com/photos/HkTMcmlMOUQ" target="_blank">
                                <div class="content-overlay"></div>
                                <img class="content-image" src="https://source.unsplash.com/HkTMcmlMOUQ" alt="">
                                <div class="content-details fadeIn-right">
                                    <h3>This is a title</h3>
                                    <p>This is a short description</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="container">
                        <h3 class="title">Text fadeIn top left</h3>
                        <div class="content">
                            <a href="https://unsplash.com/photos/HkTMcmlMOUQ" target="_blank">
                                <div class="content-overlay"></div>
                                <img class="content-image" src="https://source.unsplash.com/HkTMcmlMOUQ" alt="">
                                <div class="content-details fadeIn-top fadeIn-left">
                                    <h3>This is a title</h3>
                                    <p>This is a short description</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="container">
                        <h3 class="title">Text fadeIn top right</h3>
                        <div class="content">
                            <a href="https://unsplash.com/photos/HkTMcmlMOUQ" target="_blank">
                                <div class="content-overlay"></div>
                                <img class="content-image" src="https://source.unsplash.com/HkTMcmlMOUQ" alt="">
                                <div class="content-details fadeIn-top fadeIn-right">
                                    <h3>This is a title</h3>
                                    <p>This is a short description</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="container">
                        <h3 class="title">Text fadeIn bottom left</h3>
                        <div class="content">
                            <a href="https://unsplash.com/photos/HkTMcmlMOUQ" target="_blank">
                                <div class="content-overlay"></div>
                                <img class="content-image" src="https://source.unsplash.com/HkTMcmlMOUQ" alt="">
                                <div class="content-details fadeIn-bottom fadeIn-left">
                                    <h3>This is a title</h3>
                                    <p>This is a short description</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="container">
                        <h3 class="title">Text fadeIn bottom right</h3>
                        <div class="content">
                            <a href="https://unsplash.com/photos/HkTMcmlMOUQ" target="_blank">
                                <div class="content-overlay"></div>
                                <img class="content-image" src="https://source.unsplash.com/HkTMcmlMOUQ" alt="">
                                <div class="content-details fadeIn-bottom fadeIn-right">
                                    <h3>This is a title</h3>
                                    <p>This is a short description</p>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
