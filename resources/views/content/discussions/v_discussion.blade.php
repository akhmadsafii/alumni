@extends('layout.admin.v_main')
@section('content')
    @push('styles')
        @include('package.datatables.datatable_css')
    @endpush
    <div class="m-subheader ">
        <div class="d-flex justify-content-between">
            <h3 class="m-subheader__title">{{ session('title') }}</h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="#" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">User</span>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">{{ session('title') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="m-content">
        <div class="row">
            <div class="col-md-8">
                <div class="card rounded mb-3">
                    <div class="card-header">
                        <input type="hidden" name="id_message" value="">
                        <textarea name="chat" id="m_summernote_1" rows="4" class="form-control summernote"></textarea>
                        <div class="d-flex">
                            <button class="btn btn-success px-4 py-1 mt-2" type="submit" id="btnSubmit">Post</button>
                        </div>
                    </div>
                </div>
                <div class="card rounded mb-3">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <img class="img-xs rounded-circle" src="{{ asset('asset/img/user4.jpg') }}" width="40"
                                    alt="">
                                <div class="ml-2">
                                    <p class="m-0">AKhmad safii</p>
                                    <p class="tx-11 mb-0 text-muted">20 menit yang lalu</p>
                                </div>
                            </div>
                            <div class="dropdown">
                                <span class="dropdown">
                                    <a href="#"
                                        class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"
                                        data-toggle="dropdown" aria-expanded="true">
                                        <i class="la la-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void(0)"
                                            onclick="editData(' . $row['id'] . ')"><i class="la la-edit"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="deleteData()"><i
                                                class="la la-trash"></i>
                                            Hapus</a>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="mb-3 tx-14">Ini adalah chat
                        </p>

                    </div>
                    <div class="card-footer">
                        <div class="d-flex post-actions">
                            <a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-heart icon-md">
                                    <path
                                        d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                    </path>
                                </svg>
                                <p class="d-none d-md-block ml-2 my-auto">Like</p>
                            </a>
                            <a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-message-square icon-md">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z">
                                    </path>
                                </svg>
                                <p class="d-none d-md-block ml-2 my-auto">Comment</p>
                            </a>
                            <a href="javascript:;" class="d-flex align-items-center text-muted">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-share icon-md">
                                    <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path>
                                    <polyline points="16 6 12 2 8 6"></polyline>
                                    <line x1="12" y1="2" x2="12" y2="15">
                                    </line>
                                </svg>
                                <p class="d-none d-md-block ml-2 my-auto">Share</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card rounded mb-3">
                    <div class="card-header">
                        <h3 class="m-portlet__head-text">
                            Laporan
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex mb-2 bg-secondary rounded p-2">
                            <img src="{{ asset('asset/img/user4.jpg') }}" alt="" class="rounded-circle mr-2 my-auto" height="60">
                            <div class="information">
                                <p class="mb-0">agus susanto melaporakan postingan dari budi susanto</p>
                                <small>1 Jam yang lalu</small>
                            </div>
                        </div>
                        <div class="d-flex mb-2 rounded p-2">
                            <img src="{{ asset('asset/img/user4.jpg') }}" alt="" class="rounded-circle mr-2 my-auto" height="60">
                            <div class="information">
                                <p class="mb-0">agus susanto melaporakan postingan dari budi susanto</p>
                                <small>1 Jam yang lalu</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        @include('package.datatables.datatable_js')
        @include('component.formImageSubmit')
        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var table = $('#list-table').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: "",
                    dom: "<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>\n\t\t\t<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
                    buttons: [
                        "print", "copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5",
                    ],
                    columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'align-middle'
                    }, {
                        data: 'name',
                        name: 'name',
                    }, {
                        data: 'phone',
                        name: 'phone',
                    }, {
                        data: 'email',
                        name: 'email',
                    }, {
                        data: 'last_login',
                        name: 'last_login',
                    }, {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center align-middle'
                    }, ]
                });

                formImageSubmit('#formSubmit', '#btnSubmit', '', '#modalForm')

            })

            function addData() {
                $('#id_admin').val("");
                $('#formSubmit').trigger("reset");
                $('.modal-title').html("Tambah {{ session('title') }}");
                $('#modalForm').modal('show');
                // $('#notice_password').addClass('d-none');
            }

            function editData(id) {
                $.ajax({
                    url: '{{ route('admin.manage.detail') }}',
                    data: {
                        id
                    },
                    success: (data) => {
                        $('.modal-title').html('Edit {{ session('title') }}');
                        $('#id_admin').val(data.id);
                        $('#name').val(data.name);
                        $('#email').val(data.email);
                        $('#phone').val(data.phone);
                        $('#preview-image').attr('src', data.avatar);
                        $('#modalForm').modal('show');
                    }
                });
            }

            function deleteData(id) {
                if (confirm("Apa kamu yakin ingin menghapus data ini?") == true) {
                    $.ajax({
                        url: "{{ route('admin.manage.delete') }}",
                        data: {
                            id
                        },
                        success: function(data) {
                            $('#list-table').dataTable().fnDraw(false);
                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            toastr.error(res.message, "GAGAL");
                        }
                    })
                }
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
