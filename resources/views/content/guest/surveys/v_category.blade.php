@extends('layout.guest.v_main')
@section('content')
    @push('styles')
        <style>
            .my-card {
                position: absolute;
                top: -20px;
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
                            <h1 data-aos="fade-up" data-aos-delay="" class="aos-init aos-animate">Survey</h1>
                            <p class="mb-5 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">Pelacakan jejak
                                lulusan/alumni yang dilakukan kepada alumni 2 tahun setelah
                                lulus . Survey bertujuan untuk mengetahui outcomependidikan dalam bentuk transisi dari dunia
                                pendidikan tinggi ke dunia kerja</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if ($categories->isNotEmpty())
        <section class="section pt-3">
            <div class="container">
                <div class="row">
                    @foreach ($categories as $category)
                        @if ($category['total_pertanyaan'] != 0)
                            <div class="col-md-4">
                                <div class="card border-info mx-sm-1 p-2 m-3">
                                    <div class="card border-info shadow text-info p-3 my-card"><i
                                            class="bi bi-bar-chart-line-fill" style="font-size:26px;"></i></div>
                                    <div class="text-info text-center mt-5">
                                        <h4>{{ strtoupper($category['name']) }}</h4>
                                    </div>
                                    <div class="text-info text-center mt-2">
                                        <h1>{{ $category['total_pertanyaan'] }} Soal</h1>
                                    </div>
                                    <div class="content">
                                        <div class="d-flex justify-content-around">
                                            @if ($category['login'] == true && $category['status_terisi'] == true)
                                                <a href="{{ route('admin.answer.detail_category', $category['code']) }}"
                                                    class="btn btn-primary btn-sm mx-1"><i
                                                        class="bi bi-info-circle-fill"></i>
                                                    Detail</a>
                                            @else
                                                <a href="javascript:void(0)" class="btn btn-primary btn-sm mx-1 detail"
                                                    data-id="{{ $category['code'] }}"><i class="bi bi-info-circle-fill"></i>
                                                    Detail</a>
                                            @endif
                                            {{-- <a href="javascript:void(0)" data-id="{{ $category['code'] }}"
                                                class="btn btn-primary btn-sm mx-1 detail"><i class="bi bi-info-circle-fill"></i>
                                                Detail</a> --}}
                                            @if ($category['status_terisi'] == false)
                                                <a href="{{ route('admin.answer.category', $category['code']) }}"
                                                    class="btn btn-success btn-sm mx-1"><i
                                                        class="bi bi-play-circle-fill"></i>
                                                    Mulai</a>
                                            @endif
                                        </div>
                                        @if ($category['status_terisi'] == true)
                                            <br>
                                            <div class="text-center text-success">
                                                <span><i class="bi bi-check-circle-fill"></i> Survey telah dijawab</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    {{ $categories->links() }}
                </div>
            </div>
        </section>
    @else
        <section class="section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4 me-auto">
                        <h2 class="mb-4">Survey tidak tersedia</h2>
                        <p class="mb-4">Untuk saat ini belum ada survey yang ingin diisi. Silahkan akses dan coba dilain
                            waktu kembali</p>
                    </div>
                    <div class="col-md-6 aos-init aos-animate" data-aos="fade-left"> <img
                            src="{{ asset('asset/guest/img/empty.svg') }}" alt="Image" class="img-fluid"></div>
                </div>
            </div>
        </section>
    @endif

    @push('modals')
        <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Survey</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-6 col-form-label">Jenis</label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control-plaintext" id="name"
                                    value="email@example.com">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-6 col-form-label">Total Pertanyaan</label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control-plaintext" id="amount_total"
                                    value="email@example.com">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-6 col-form-label">Inputan Teks</label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control-plaintext" id="amount_teks"
                                    value="email@example.com">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-6 col-form-label">Pilihan</label>
                            <div class="col-sm-6">
                                <input type="text" readonly class="form-control-plaintext" id="amount_options"
                                    value="email@example.com">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endpush
    @push('scripts')
        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $(document).on('click', '.detail', function() {
                    let code = $(this).data('id');
                    $.ajax({
                        url: "{{ route('detail_category') }}",
                        data: {
                            code
                        },
                        success: function(data) {
                            $('#name').val(data.name);
                            $('#amount_total').val(data.total_question);
                            $('#amount_options').val(data.total_option);
                            $('#amount_teks').val(data.total_essay);
                            $('#modalDetail').modal('show');
                        }
                    });
                });
            })
        </script>
    @endpush
@endsection
