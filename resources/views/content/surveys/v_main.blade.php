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
                        <span class="m-nav__link-text">Survey</span>
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
                <button class="btn btn-block btn-primary" onclick="addCategory()"><i class="la la-plus"></i> Tambah Kategori
                    Baru</button>
                <div class="card rounded mt-2">
                    <ul class="list-group">
                        @foreach ($categories as $ctg)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{ route('admin.survey.detail', $ctg['code']) }}">
                                    {{ $ctg['name'] }}
                                </a>
                                <div class="action">
                                    <a href="javascript:void(0)" onclick="deleteData({{ $ctg['id'] }})"
                                        class="btn btn-danger m-btn m-btn--icon m-btn--icon-only mx-1">
                                        <i class="la la-trash"></i>
                                    </a>
                                    <a href="javascript:void(0)" onclick="editData({{ $ctg['id'] }})"
                                        class="btn btn-primary m-btn m-btn--icon m-btn--icon-only mx-1">
                                        <i class="la la-pencil"></i>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
            <div class="col-md-8">
                @yield('survey')
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
        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#formSubmit').on('submit', function(event) {
                    event.preventDefault();
                    $('#btnSubmit').addClass('m-loader m-loader--light m-loader--right');
                    $('#btnSubmit').attr("disabled", true);
                    $.ajax({
                        url: '{{ route('admin.category.store') }}',
                        method: "POST",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(data) {
                            window.location.reload();
                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            toastr.error(res.message, "GAGAL");
                            $('#btnSubmit').removeClass('m-loader m-loader--light m-loader--right');
                            $('#btnSubmit').attr("disabled", false);
                        }
                    });
                });
            })

            function addCategory() {
                $('#id_category').val("");
                $('#formSubmit').trigger("reset");
                $('.modal-title').html("Tambah Kategori");
                $('#modalForm').modal('show');
            }

            function editData(id) {
                $.ajax({
                    url: '{{ route('admin.category.detail') }}',
                    data: {
                        id
                    },
                    success: (data) => {
                        $('.modal-title').html('Edit Kategori');
                        $('#id_category').val(data.id);
                        $('#name').val(data.name);
                        $('#modalForm').modal('show');
                    }
                });
            }

            function deleteData(id) {
                if (confirm("Apa kamu yakin ingin menghapus data ini?") == true) {
                    $.ajax({
                        url: "{{ route('admin.category.delete') }}",
                        data: {
                            id
                        },
                        success: function(data) {
                            window.location.reload();
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
