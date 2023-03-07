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
                            <table class="table table-hover" id="list-table">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="m-checkbox-list">
                                                <label class="m-checkbox">
                                                    <input type="checkbox" name="item[]" value=""
                                                        class="check_items">&nbsp;
                                                    <span></span>
                                                </label>
                                            </div>
                                        </th>
                                        <th>Judul</th>
                                        <th>Pembuat</th>
                                        <th>Waktu Pelaksanaan</th>
                                        <th>Tempat</th>
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
                            <input type="hidden" name="id" id="id_agenda">
                            <div class="form-group">
                                <label>Nama Judul</label>
                                <input type="text" class="form-control m-input" id="title" name="title"
                                    placeholder="Judul Agenda">
                            </div>
                            <div class="form-group">
                                <label>Tempat</label>
                                <input type="text" class="form-control m-input" id="location" name="location"
                                    placeholder="Tempat">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Waktu Mulai</label>
                                        <div class="input-group date">
                                            <input type="text" name="start_date" id="start_date"
                                                class="form-control m-input m_datetimepicker_3" readonly
                                                value="{{ now() }}" />
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i
                                                        class="la la-calendar-check-o glyphicon-th"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Selesai</label>
                                        <div class="input-group date">
                                            <input type="text" name="end_date" id="end_date"
                                                class="form-control m-input m_datetimepicker_3" readonly
                                                value="{{ now() }}" />
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i
                                                        class="la la-calendar-check-o glyphicon-th"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea name="description" id="description" rows="3" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Gambar</label>
                                        <input type="file" name="file" class="form-control-file"
                                            onchange="readURL(this);">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <img id="preview-image" src="https://via.placeholder.com/150" alt="Preview"
                                        class="w-100">
                                </div>
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
        <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="detail-agenda">
                    </div>
                </div>
            </div>
        </div>
    @endpush
    @push('scripts')
        @include('package.datatables.datatable_js')
        @include('package.datetimepicker.datetimepicker_js')
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
                        data: 'title',
                        name: 'title',
                    }, {
                        data: 'author',
                        name: 'author',
                    }, {
                        data: 'time',
                        name: 'time',
                    }, {
                        data: 'location',
                        name: 'location',
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

                formImageSubmit('#formSubmit', '#btnSubmit', '', '#modalForm')

            })

            function addData() {
                $('#id_agenda').val("");
                $('#formSubmit').trigger("reset");
                $('.modal-title').html("Tambah {{ session('title') }}");
                $('#modalForm').modal('show');
            }

            function editData(id) {
                $.ajax({
                    url: '{{ route('admin.agenda.detail') }}',
                    data: {
                        id
                    },
                    success: (data) => {
                        $('.modal-title').html('Edit {{ session('title') }}');
                        $('#id_agenda').val(data.id);
                        $('#title').val(data.title);
                        $('#location').val(data.location);
                        $('#start_date').val(data.start_date);
                        $('#end_date').val(data.end_date);
                        $('#description').val(data.description);
                        if (data.file) {
                            $('#preview-image').attr('src', data.file);
                        } else {
                            $('#preview-image').attr('src', 'https://via.placeholder.com/150');
                        }
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

            function detailData(id) {
                $.ajax({
                    url: '{{ route('admin.agenda.full_detail') }}',
                    data: {
                        id
                    },
                    success: (data) => {
                        let detail = `
                        <ul class="list-unstyled">
                            <li class="media">
                                <img src="${data.file}" class="align-self-center mr-3"
                                    width="150" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-1">${data.title}</h5>
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="la la-map-marker"></i>
                                        </div>
                                        <div class="m-demo-icon__class">${data.location}</div>
                                    </div>
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="la la-clock-o"></i>
                                        </div>
                                        <div class="m-demo-icon__class">${data.start_date}</div>
                                    </div>
                                    <div class="m-demo-icon">
                                        <div class="m-demo-icon__preview">
                                            <i class="la la-info-circle"></i>
                                        </div>
                                        <div class="m-demo-icon__class">${data.description}</div>
                                    </div>
                                    <p>Dibuat oleh ${data.user} &#x2022; ${data.created_at}</p>
                                </div>
                            </li>
                        </ul>
                        `;
                        if (data.status === 2) {
                            detail += `
                            <div class="row">
                                <div class="col-6 col-md-6">
                                    <button type="button" class="btn m-btn--pill btn-danger btn-block" onclick="update_status(${data.id},3)">Tolak</button>
                                </div>
                                <div class="col-6 col-md-6">
                                    <button type="button" class="btn m-btn--pill btn-success btn-block" onclick="update_status(${data.id},1)">Terima</button>
                                </div>
                            </div>
                            `;
                        }
                        $('#detail-agenda').html(detail);
                        $('#modalDetail').modal('show');
                    }
                });
            }

            function update_status(id, status) {
                $.ajax({
                    url: "{{ route('admin.agenda.update_status') }}",
                    data: {
                        id,
                        status
                    },
                    success: function(data) {
                        $('#list-table').dataTable().fnDraw(false);
                        $('#modalDetail').modal('hide');
                    }
                });
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
