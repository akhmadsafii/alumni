@extends('layout.guest.v_main')
@section('content')
    @push('styles')
        @include('package.calendar.calendar_css')
        <style>
            a.nav-link.active {
                color: #000;
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
                            <h1 data-aos="fade-up" data-aos-delay="" class="aos-init aos-animate">Agenda</h1>
                            <p class="mb-5 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">Kegiatan yang masih
                                dilakukan oleh para alumni guna mempererat tali
                                silahturahmi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-2 p-2">
                        <nav class="nav">
                            <a class="nav-link {{ $_GET['appear'] == 'all' ? 'active' : '' }}"
                                href="{{ route('agenda', ['appear' => 'all']) }}">Semua</a>
                            <a class="nav-link {{ $_GET['appear'] == 'not-yet' ? 'active' : '' }}"
                                href="{{ route('agenda', ['appear' => 'not-yet']) }}">Belum Terlaksana</a>
                            <a class="nav-link {{ $_GET['appear'] == 'done' ? 'active' : '' }}"
                                href="{{ route('agenda', ['appear' => 'done']) }}">Sudah
                                Terlaksana</a>
                        </nav>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between my-2">
                                <form class="row gy-2 gx-3 align-items-center" action="">
                                    <div class="col-auto">
                                        <input type="hidden" name="appear" value="{{ $_GET['appear'] }}">
                                        <label class="visually-hidden" for="autoSizingInput">Name</label>
                                        <input type="text" class="form-control" id="search" name="search"
                                            @isset($sort_search) value="{{ $sort_search }}" @endisset
                                            placeholder="Type & Enter">
                                    </div>
                                </form>
                                @if (Auth::guard('user')->check())
                                    <button class="btn btn-sm btn-primary" onclick="addData()"><i
                                            class="bi bi-plus-circle"></i> Tambah
                                        Agenda</button>
                                @endif
                            </div>
                            <hr>
                            @if ($agendas->isNotEmpty())
                                @foreach ($agendas as $agenda)
                                    <div class="card mb-3">
                                        <div class="row g-0">
                                            <div class="col-md-4 my-auto">
                                                <img src="{{ $agenda['file'] }}" class="img-fluid rounded-start">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $agenda['title'] }}
                                                    </h5>
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item"><span><i class="bi bi-pin-map"></i>
                                                                {{ $agenda['location'] }}</span>
                                                        </li>
                                                        <li class="list-group-item"><span><i class="bi bi-clock"></i>
                                                                {{ $agenda['start_date'] }}</span>
                                                        </li>
                                                        <li class="list-group-item"><span><i class="bi bi-info-circle"></i>
                                                                {!! Str::limit($agenda['description'], 100) !!}</span></li>
                                                    </ul>
                                                    <p class="card-text"><small class="text-muted">Dibuat oleh
                                                            {{ $agenda['user'] }}
                                                            &nbsp; &#x2022; &nbsp;
                                                            {{ $agenda['created_at'] }}</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="d-flex justify-content-center">
                                    {{ $agendas->links() }}
                                </div>
                            @else
                                <div class="row align-items-center">
                                    <div class="col-md-4 me-auto">
                                        <h2 class="mb-4 text-center">Data tidak tersedia</h2>
                                    </div>
                                    <div class="col-md-6 aos-init aos-animate" data-aos="fade-left"> <img
                                            src="{{ asset('asset/guest/img/empty.svg') }}" alt="Image"
                                            class="img-fluid"></div>
                                </div>
                            @endif

                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-center mb-3">
                        <div class="auto-jsCalendar"></div>
                    </div>
                    @if (Auth::guard('user')->check())
                        <div class="card">
                            <div class="card-header">
                                <h3 class="my-0 text-center">Agenda Saya</h3>
                            </div>
                            <ul class="list-group">
                                @if (count($my_agenda) > 0)
                                    @foreach ($my_agenda as $my_agen)
                                        <li class="list-group-item p-3">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ $my_agen['file'] }}" class="img-fluid" alt="quixote"
                                                        width="125">
                                                </div>
                                                <div class="flex-grow-1 ms-3 d-flex align-content-between flex-wrap">
                                                    <h5>{{ $my_agen['title'] }}</h5>
                                                    <span
                                                        class="badge rounded-pill bg-{{ StatusHelper::agendas($my_agen['status'])['class'] }}">{{ StatusHelper::agendas($my_agen['status'])['message'] }}</span>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="list-group-item d-flex align-items-censter">
                                        <div class="row align-items-center">
                                            <div class="col-md-7 me-auto">
                                                <h2 class="text-center">Data tidak tersedia</h2>
                                            </div>
                                            <div class="col-md-5 aos-init aos-animate" data-aos="fade-left"> <img
                                                    src="{{ asset('asset/guest/img/empty.svg') }}" alt="Image"
                                                    class="img-fluid"></div>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    @endif
                </div>
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
        @include('package.datetimepicker.datetimepicker_js')
        @include('package.calendar.calendar_js')
        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('body').on('submit', '#formSubmit', function(e) {
                    e.preventDefault();
                    $('#btnSubmit').attr("disabled", true);
                    var formData = new FormData(this);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.agenda.store') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            window.location.reload();
                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            console.log(res.message);
                            // toastr.error(res.message, "GAGAL");
                            $('#btnSubmit').attr("disabled", false);
                        }
                    });
                });
            })

            function addData() {
                $('#formSubmit').trigger("reset");
                $('.modal-title').html("Tambah {{ session('title') }}");
                $('#modalForm').modal('show');
            }

            function readURL(input, id) {
                id = id || '#preview-image';
                if (input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(id).attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endpush
@endsection
