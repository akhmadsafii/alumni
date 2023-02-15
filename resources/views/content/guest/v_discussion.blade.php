@extends('layout.guest.v_main')
@section('content')
    @push('styles')
        <style>
            .hero-section {
                height: auto !important;
            }

            .container.p-5.bg-light {
                margin-top: 120px;
            }

            @media only screen and (max-width: 480px) {
                .container.p-5.bg-light {
                    margin-top: 85px !important;
                    width: auto !important;
                    margin: 0 10px;
                    padding: 10px !important;
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

        <div class="container p-5 bg-light rounded">
            <div class="text-center">
                <h2 class="mt-3">Diskusi</h2>
                <p class="mt-3 text-secondary">media diskusi online yang dapat diakses tanpa dibatasi ruang dan waktu.
                    Melalui forum, Para alumni dapat berdiskusi satu sama lain mengenai suatu topik yang dimoderasi oleh
                    moderator sehingga diskusi berjalan secara kondusif.</p>
            </div>
            <hr>
            <div class="row px-3">
                <div class="col-md-12">
                    <div class="card gedf-card mb-3">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts"
                                        role="tab" aria-controls="posts" aria-selected="true">Make
                                        a publication</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="images-tab" data-toggle="tab" role="tab"
                                        aria-controls="images" aria-selected="false" href="#images">Images</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="posts" role="tabpanel"
                                    aria-labelledby="posts-tab">
                                    <div class="form-group">
                                        {{-- <label class="sr-only" for="message">post</label> --}}
                                        <textarea class="form-control" id="message" rows="3" placeholder="What are you thinking?"></textarea>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Upload image</label>
                                        </div>
                                    </div>
                                    <div class="py-4"></div>
                                </div>
                            </div>
                            <div class="btn-toolbar justify-content-between mt-2">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-primary">share</button>
                                </div>
                                <div class="btn-group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-link dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-globe"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" href="#"><i class="fa fa-globe"></i> Public</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-users"></i> Friends</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Just me</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card gedf-card mb-3">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-2">
                                        <img class="rounded-circle" width="45" src="https://picsum.photos/50/50"
                                            alt="">
                                    </div>
                                    <div class="ml-2">
                                        <div class="h5 m-0">@LeeCross</div>
                                        <div class="h7 text-muted">Miracles Lee Cross</div>
                                    </div>
                                </div>
                                <div>
                                    <div class="dropdown">
                                        <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                            <div class="h6 dropdown-header">Configuration</div>
                                            <a class="dropdown-item" href="#">Save</a>
                                            <a class="dropdown-item" href="#">Hide</a>
                                            <a class="dropdown-item" href="#">Report</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i> 10 min ago</div>
                            <a class="card-link" href="#">
                                <h5 class="card-title"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit
                                    consectetur
                                    deserunt illo esse distinctio.</h5>
                            </a>

                            <p class="card-text text-muted">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam omnis nihil, aliquam est,
                                voluptates officiis iure soluta
                                alias vel odit, placeat reiciendis ut libero! Quas aliquid natus cumque quae repellendus.
                                Lorem
                                ipsum dolor sit amet consectetur adipisicing elit. Ipsa, excepturi. Doloremque,
                                reprehenderit!
                                Quos in maiores, soluta doloremque molestiae reiciendis libero expedita assumenda fuga quae.
                                Consectetur id molestias itaque facere? Hic!
                            </p>
                            <div>
                                <span class="badge badge-primary">JavaScript</span>
                                <span class="badge badge-primary">Android</span>
                                <span class="badge badge-primary">PHP</span>
                                <span class="badge badge-primary">Node.js</span>
                                <span class="badge badge-primary">Ruby</span>
                                <span class="badge badge-primary">Paython</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="card-link"><i class="fa fa-gittip"></i> Like</a>
                            <a href="#" class="card-link"><i class="fa fa-comment"></i> Comment</a>
                            <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Share</a>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </section>
@endsection
