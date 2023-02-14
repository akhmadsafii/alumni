@extends('layout.admin.v_main')
@section('content')
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
            </div>
            <form class="m-form m-form--fit m-form--label-align-right" id="formSubmit">
                <div class="m-portlet__body">
                    <input type="hidden" name="id" value="{{ $action == 'edit' ? $blog['id'] : null }}">
                    <div class="form-group m-form__group">
                        <label>Kategori Blog:</label>
                        <select name="id_category_other" id="id_category_other" class="form-control">
                            <option value="" selected disabled>Pilih Kategori</option>
                            @foreach ($categories as $ctg)
                                <option value="{{ $ctg['id'] }}"
                                    {{ $action == 'edit' && $blog['id_category_other'] == $ctg['id'] ? 'selected' : '' }}>
                                    {{ $ctg['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group m-form__group">
                        <label>Judul:</label>
                        <input type="text" name="title" id="title"
                            value="{{ $action == 'edit' ? $blog['title'] : '' }}" class="form-control">
                    </div>
                    <div class="form-group m-form__group">
                        <label>Isi:</label>
                        <textarea name="content" id="content" class="form-control summernote">{!! $action == 'edit' ? $blog['content'] : '' !!}</textarea>
                    </div>
                    <div class="form-group m-form__group">
                        <label>Gambar:</label>
                        <input type="file" name="file" class="form-control-file" onchange="readURL(this);">
                        <img id="preview-image" src="{{ $action == 'edit' && $blog['file'] != null ? asset($blog['file']) : 'https://via.placeholder.com/150' }}" alt="Preview" class="mt-2"
                            width="150">
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions--solid">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="submit" id="btnSubmit" class="btn btn-primary">Save</button>
                                <button type="button" onclick="resetForm()" class="btn btn-secondary">Batalkan</button>
                            </div>
                            <div class="col-lg-6 m--align-right">
                                <button type="button" onclick="deleteForm()" id="btn-delete"
                                    class="btn btn-danger">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        @include('package.summernote.summernote_js')
        @include('component.formImageSubmit')
        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                $('body').on('submit', '#formSubmit', function(e) {
                    e.preventDefault();
                    $('#btnSubmit').addClass('m-loader m-loader--light m-loader--right');
                    $('#btnSubmit').attr("disabled", true);
                    var formData = new FormData(this);
                    $.ajax({
                        type: "POST",
                        url: '{{ route('admin.blog.store') }}',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            toastr.success(data.message, "Berhasil");
                            window.location.href = "{{ route('admin.blog.page') }}"
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
