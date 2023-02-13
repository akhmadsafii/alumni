@extends('layout.admin.v_main')
@section('content')
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
            <div class="col-md-4">
                <button class="btn btn-block btn-primary"><i class="la la-plus"></i> Tambah Kategori Baru</button>
                <div class="card rounded mt-2">
                    <div class="card-body">

                    </div>
                </div>
                
            </div>
            <div class="col-md-8">
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
