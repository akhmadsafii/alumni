@extends('layout.admin.v_main')
@section('content')
    @push('styles')
        @include('package.datatables.datatable_css')
    @endpush
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{ session('title') }}</h3>
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
    </div>
    <div class="m-content">
        <div class="m-portlet m-portlet--tab">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ session('title') }}
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="javascript:void(0)" onclick="addData()"
                                class="btn btn-success m-btn m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>Tambah</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-section">
                    <div class="m-section__content">
                        <div class="table-responsive">
                            <table class="table table-hover datatable">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="m-checkbox-list">
                                                <label class="m-checkbox">
                                                    <input type="checkbox" value="" id="select_all">&nbsp;
                                                    <span></span>
                                                </label>
                                            </div>
                                        </th>
                                        <th>Nama Kategori</th>
                                        <th>Jumlah Gambar</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @push('modals')
        <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formSubmit">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id_category">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control m-input" id="name" name="name"
                                    placeholder="Nama Kategori">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="btnSubmit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endpush
    @push('scripts')
        @include('package.datatables.datatable_js')
        @include('component.formSubmit')
        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var table = $('.datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: "",
                    dom: "<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>\n\t\t\t<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
                    buttons: [
                        "print", "copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5",
                    ],
                    columns: [{
                        data: 'check',
                        name: 'check',
                        orderable: false,
                        searchable: false,
                        className: 'align-middle'
                    }, {
                        data: 'name',
                        name: 'name',
                    }, {
                        data: 'total',
                        name: 'total',
                    }, {
                        data: 'status',
                        name: 'status',
                    }, {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center align-middle'
                    }, ]
                });

                formSubmit('#formSubmit', '#btnSubmit', '', '#modalForm')

                $(document).on('click', '.update_status', function() {
                    let id = $(this).data('id');
                    let status = $(this).is(':checked') ? 1 : 2;
                    $.ajax({
                        url: "{{ route('admin.cluster.update_status') }}",
                        data: {
                            id, status
                        },
                        success: function(data) {
                            console.log(data)
                        }
                    });
                });

            })

            function addData() {
                $('#id_category').val("");
                $('#formSubmit').trigger("reset");
                $('.modal-title').html("Tambah {{ session('title') }}");
                $('#modalForm').modal('show');
                // $('#notice_password').addClass('d-none');
            }

            function editData(id) {
                $.ajax({
                    url: '{{ route('admin.cluster.detail') }}',
                    data: {
                        id
                    },
                    success: (data) => {
                        $('.modal-title').html('Edit {{ session('title') }}');
                        $('#id_category').val(data.id);
                        $('#name').val(data.name);
                        $('#modalForm').modal('show');
                    }
                });
            }

            function deleteData(id) {
                if (confirm("Apa kamu yakin ingin menghapus data ini?") == true) {
                    $.ajax({
                        url: "{{ route('admin.cluster.delete') }}",
                        data: {
                            id
                        },
                        success: function(data) {
                            $('.datatable').dataTable().fnDraw(false);
                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            toastr.error(res.message, "GAGAL");
                        }
                    })
                }
            }
        </script>
    @endpush
@endsection
