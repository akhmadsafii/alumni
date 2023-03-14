@extends('layout.guest.v_main')
@section('content')
    @push('styles')
        <style>
            .hover {
                overflow: hidden;
                position: relative;
                padding-bottom: 60%;
            }

            .hover-overlay {
                width: 100%;
                height: 100%;
                position: absolute;
                top: 0;
                left: 0;
                z-index: 90;
                transition: all 0.4s;
            }

            .hover img {
                width: 100%;
                position: absolute;
                top: 0;
                left: 0;
                transition: all 0.3s;
            }

            .hover-content {
                position: relative;
                z-index: 99;
            }

            .hover-1 img {
                width: 105%;
                position: absolute;
                top: 0;
                left: -5%;
                transition: all 0.3s;
            }

            .hover-1-content {
                position: absolute;
                bottom: 0;
                left: 0;
                z-index: 99;
                transition: all 0.4s;
            }

            .hover-1 .hover-overlay {
                background: rgba(0, 0, 0, 0.5);
            }

            .hover-1-description {
                transform: translateY(0.5rem);
                transition: all 0.4s;
                opacity: 0;
            }

            .hover-1:hover .hover-1-content {
                bottom: 2rem;
            }

            .hover-1:hover .hover-1-description {
                opacity: 1;
                transform: none;
            }

            .hover-1:hover img {
                left: 0;
            }

            .hover-1:hover .hover-overlay {
                opacity: 0;
            }

            .custom-search-botton {
                right: 3px;
                top: 3px;
                bottom: 3px;
                line-height: 1 !important;
                z-index: 7 !important;
            }
        </style>
    @endpush
    <section class="hero-section inner-page">
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
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="row justify-content-center">
                        <div class="col-md-7 text-center hero-text">
                            <h1 data-aos="fade-up" data-aos-delay="" class="aos-init aos-animate">Galleri</h1>
                            <p class="mb-5 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">Abadikan moment
                                terbaikmu bersama teman disini.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section pt-3">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12">
                    <div class="row align-items-center mb-5">
                        <div class="col-8 mx-auto">
                            <form action="">
                                <div class="input-group custom-search position-relative">
                                    <input type="text" class="form-control custom-search-input w-100" id="search"
                                        name="search"
                                        @isset($sort_search) value="{{ $sort_search }}" @endisset
                                        placeholder="Masukan Pencarian">
                                    <button class="btn btn-primary custom-search-botton position-absolute"
                                        type="submit">Cari</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                @if (Auth::guard('user')->check())
                    <div class="col-lg-3 col-md-4 col-6">
                        <label class="file_upload" onclick="addData()"
                            style="width: 100%; height: 200px; border: 2px dashed #ddd; border-radius: 3px; cursor: pointer; text-align: center; overflow: hidden; padding: 5px; margin-top: 5px; margin-bottom : 5px; position : relative; display: flex; align-items: center; margin: auto; justify-content: center; flex-direction: column;"><a
                                href="javascript:void(0)" data-spartanindexremove="5"
                                style="position: absolute !important; right : 3px; top: 3px; display : none; background : #ED3C20; border-radius: 3px; width: 30px; height: 30px; line-height : 30px; text-align: center; text-decoration : none; color : #FFF;"
                                class="spartan_remove_row"><i class="fa fa-times"></i></a><img
                                style="width: 64px; margin: 0 auto; vertical-align: middle;" data-spartanindexi="5"
                                src="data:image/png;base64,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"
                                class="spartan_image_placeholder">
                            <p data-spartanlbldropfile="5" style="color : #5FAAE1; display: none; width : auto; ">Drop Here
                            </p>
                            <img style="width: 100%; vertical-align: middle; display:none;" class="img_"
                                data-spartanindeximage="5">
                        </label>
                    </div>
                @endif
                @foreach ($galleries as $gallery)
                    @php
                        $image = json_decode($gallery['file']);
                        $image = asset(reset($image));
                    @endphp
                    <div class="col-lg-3 col-md-4 col-6">
                        <a href="{{ route('gallery.detail', $gallery['code']) }}">
                            <div class="hover hover-1 text-white rounded"><img src="{{ $image }}" alt="">
                                <div class="hover-overlay"></div>
                                <div class="hover-1-content px-5 pt-4">
                                    <h3 class="hover-1-title text-uppercase font-weight-bold mb-0 text-light">
                                        {{ $gallery['name'] }}</h3>
                                    <p class="hover-1-description font-weight-light mb-0">{!! Str::limit($gallery['description'], 100) !!}</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center my-2">
                                <div class="d-flex justify-content-start align-items-center">
                                    <img src="{{ $gallery['avatar'] }}" alt="avatar" class="img-fluid rounded-circle me-3"
                                        width="35">
                                    <p class="my-0"><strong>{{ $gallery['user'] }}</strong></p>
                                </div>
                                <span>
                                    <i class="bi bi-eye-fill"></i> {{ $gallery['total_seen'] }}
                                </span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @push('modals')
        <div class="modal fade" id="modalForm" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="formSubmit" action="javascript:void(0)">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id_agenda">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Tempat</label>
                                <input type="text" class="form-control" id="location" name="location">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Waktu Mulai</label>
                                        <input type="datetime-local" name="start_date" id="start_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Waktu Selesai</label>
                                        <input type="datetime-local" name="end_date" id="end_date" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Keterangan</label>
                                        <textarea name="description" id="description" rows="4" class="form-control"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Gambar</label>
                                        <input type="file" onchange="readURL(this);" name="file" id="file"
                                            class="form-control-file">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <img id="preview-image" src="https://via.placeholder.com/150" alt="Preview"
                                        class="w-100">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="btnSubmit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endpush
    @push('scripts')
        <script>
            function addData() {
                $('#formSubmit').trigger("reset");
                $('.modal-title').html("Tambah {{ session('title') }}");
                $('#modalForm').modal('show');
            }
        </script>
    @endpush
@endsection
