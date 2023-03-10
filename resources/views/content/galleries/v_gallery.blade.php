@extends('layout.admin.v_main')
@section('content')
    @push('styles')
        @include('package.swipper.swipper_css')
        @include('package.datatables.datatable_css')
        <style>
            .slick-prev:before,
            .slick-next:before {
                color: rgb(40, 108, 197);
            }
        </style>
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
                            <table class="table table-hover datatable" id="list-table">
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
                                        <th>Gambar</th>
                                        <th>Pembuat</th>
                                        <th>Tanggal</th>
                                        <th>Publish</th>
                                        <th>Status</th>
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
                            <input type="hidden" name="id" id="id_gallery">

                            <div class="form-group">
                                <div id="multiple_image" class="row">

                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control m-input" id="name" name="name"
                                    placeholder="Nama Kategori">
                            </div>

                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="description" id="description" rows="3" class="form-control summernote"></textarea>
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
        <div class="modal fade" id="modalGallery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="title-gallery">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="wrap-modal-slider">
                            <div class="reviews-page-carousel">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endpush
    @push('scripts')
        @include('package.datatables.datatable_js')
        @include('package.uploadimage.multiupload_js')
        @include('package.summernote.summernote_js')
        @include('package.swipper.swipper_js')
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
                        data: 'check',
                        name: 'check',
                        orderable: false,
                        searchable: false,
                        className: 'align-middle'
                    }, {
                        data: 'name',
                        name: 'name',
                    }, {
                        data: 'author',
                        name: 'author',
                    }, {
                        data: 'date',
                        name: 'date',
                    }, {
                        data: 'publish',
                        name: 'publish',
                    }, {
                        data: 'status',
                        name: 'status',
                    }, ]
                });

                formImageSubmit('#formSubmit', '#btnSubmit', '{{ route('admin.gallery.store') }}', '#modalForm')

                $(document).on('click', '.update_status', function() {
                    let id = $(this).data('id');
                    let status = $(this).is(':checked') ? 1 : 2;
                    $.ajax({
                        url: "{{ route('admin.gallery.update_status') }}",
                        data: {
                            id,
                            status
                        },
                        success: function(data) {
                            console.log(data)
                        }
                    });
                });

                $(document).on('click', '.update_publish', function() {
                    let id = $(this).data('id');
                    let status = $(this).is(':checked') ? 1 : 0;
                    $.ajax({
                        url: "{{ route('admin.gallery.update_publish') }}",
                        data: {
                            id,
                            status
                        },
                        success: function(data) {
                            console.log(data)
                        }
                    });
                });

                $("#multiple_image").spartanMultiImagePicker({
                    fieldName: 'file[]',
                    maxCount: 10,
                    rowHeight: '200px',
                    groupClassName: 'col-md-6 col-sm-6 col-xs-12',
                    maxFileSize: '',
                    dropFileLabel: "Drop Here",
                    onExtensionErr: function(index, file) {
                        console.log(index, file, 'extension err');
                        alert('Please only input png or jpg type file')
                    },
                    onSizeErr: function(index, file) {
                        console.log(index, file, 'file size too big');
                        alert('File size too big');
                    }
                });



            })

            function destroyCarousel() {
                if ($('.reviews-page-carousel').hasClass('slick-initialized')) {
                    $('.reviews-page-carousel').slick('unslick');
                }
            }


            function applySlider() {
                $('.reviews-page-carousel').slick({
                    dots: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    speed: 300,
                    fade: true,
                    infinite: true
                });
                setTimeout(() => {
                    $('.reviews-page-carousel').slick('refresh');
                }, 1000);
            }

            function addData() {
                $('#id_category').val("");
                $('#formSubmit').trigger("reset");
                $('.modal-title').html("Tambah {{ session('title') }}");
                $('#modalForm').modal('show');
            }

            function loadImage(id) {
                $.ajax({
                    url: '{{ route('admin.gallery.load_image') }}',
                    data: {
                        id
                    },
                    success: function(result) {
                        destroyCarousel();
                        $('.reviews-page-carousel').html('');
                        $('.reviews-page-carousel').html(result.source_html); // apply new data
                        applySlider();
                        $('.title-gallery').html(result.gallery);
                        $('#modalGallery').modal('show');
                    },
                    error: function() {
                        alert('Error');
                    }
                });
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
                            $('#list-table').dataTable().fnDraw(false);
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
