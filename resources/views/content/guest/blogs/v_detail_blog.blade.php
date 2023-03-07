@extends('layout.guest.v_main')
@section('content')
    @push('styles')
        <style>
            #header {
                background: rgba(39, 70, 133, 0.8);
            }

            .img-blog {
                background-size: 100%;
                background-position: center center;
                background-repeat: no-repeat;
                /* height: 262px; */
                height: 450px !important;
                width: 100%;
                transition: background ease-out 200ms;
                border-radius: 10px;
            }

            @media only screen and (max-width: 480px) {
                .img-blog {
                    height: 262px !important;
                }
            }
        </style>
    @endpush
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="post-text">

                        <h3><a href="#">Chrome now alerts you when someone steals your password</a></h3>

                        <div class="d-flex justify-content-between align-items-center my-2">
                            <div class="d-flex justify-content-start align-items-center">
                                @php
                                    if ($blog['role'] == 'admin') {
                                        $avatar = $blog['file_admin'] ? asset($blog['file_admin']) : asset('asset/img/user4.jpg');
                                        $user = $blog['name_admin'];
                                    } else {
                                        $avatar = $blog['file_user'] ? asset($blog['file_user']) : asset('asset/img/user4.jpg');
                                        $user = $blog['name_user'];
                                    }
                                @endphp
                                <img src="{{ $avatar }}" alt="avatar" class="img-fluid rounded-circle me-3"
                                    width="50">
                                <ul class="list-unstyled my-0">
                                    <li>
                                        <h5 class="mb-0">{{ $user }}</h5>
                                        <span>2 Jam yang lalu</span>
                                    </li>

                                </ul>
                            </div>
                            <span>
                                24
                            </span>
                        </div>
                        <a href=""></a>
                        <div class="img-blog"
                            style="background-image: url('{{ $blog->file != null ? asset($blog->file) : asset('asset/img/no_image.jpeg') }}')">
                        </div>
                        <p>{!! $blog['content'] !!}</p>

                    </div>
                    <div class="col-md-12">
                        <div class="main">
                            @include('component.disquss_comment')
                        </div>
                    </div>
                </div>
            </div>
    </section>
    @push('scripts')
    @endpush
@endsection
