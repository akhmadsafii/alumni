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
            <div class="col-md-8">
                <form id="formSubmit">
                    <div class="card rounded mb-3">
                        <div class="card-header">
                            <textarea name="content" rows="4" class="form-control summernote"></textarea>
                            <div class="d-flex">
                                <button class="btn btn-success px-4 py-1 mt-2" type="submit" id="btnSubmit">Post</button>
                            </div>
                        </div>
                    </div>
                </form>
                @foreach ($discussions as $discussion)
                    <div class="card rounded mb-3">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img class="img-xs rounded-circle" src="{{ $discussion['file'] }}" width="40"
                                        alt="">
                                    <div class="ml-2">
                                        <p class="m-0">{{ $discussion['name'] }}</p>
                                        <p class="tx-11 mb-0 text-muted">{{ $discussion['created_at'] }}</p>
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
                                                onclick="editData({{ $discussion['id'] }})"><i class="la la-ban"></i>
                                                Laporkan</a>
                                            <a class="dropdown-item" href="javascript:void(0)"
                                                onclick="editData({{ $discussion['id'] }})"><i class="la la-edit"></i>
                                                Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)"
                                                onclick="deleteData({{ $discussion['id'] }})"><i class="la la-trash"></i>
                                                Hapus</a>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="mb-3 tx-14">{!! $discussion['content'] !!}
                            </p>

                        </div>
                        <div class="card-footer">
                            <div class="d-flex post-actions">
                                <a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-heart icon-md">
                                        <path
                                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                        </path>
                                    </svg>
                                    <p class="d-none d-md-block ml-2 my-auto">Like</p>
                                </a>
                                <a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-message-square icon-md">
                                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z">
                                        </path>
                                    </svg>
                                    <p class="d-none d-md-block ml-2 my-auto">Comment</p>
                                </a>
                                <a href="javascript:;" class="d-flex align-items-center text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-share icon-md">
                                        <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path>
                                        <polyline points="16 6 12 2 8 6"></polyline>
                                        <line x1="12" y1="2" x2="12" y2="15">
                                        </line>
                                    </svg>
                                    <p class="d-none d-md-block ml-2 my-auto">Share</p>
                                </a>
                            </div>
                        </div>
                        @if (!empty($discussion['comment']))
                            <div class="card-body">
                                <div class="m-widget3">
                                    @foreach ($discussion['comment'] as $comment)
                                        <div class="m-widget3__item">
                                            <div class="m-widget3__header">
                                                <div class="m-widget3__user-img">
                                                    <img class="m-widget3__img" src="{{ $comment['file'] }}"
                                                        alt="">
                                                </div>
                                                <div class="m-widget3__info">
                                                    <span class="m-widget3__username">
                                                        {{ $comment['name'] }}
                                                    </span><br>
                                                    <span class="m-widget3__time">
                                                        {{ $comment['created_at'] }}
                                                    </span>
                                                </div>
                                                <span class="dropdown">
                                                    <a href="#"
                                                        class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"
                                                        data-toggle="dropdown" aria-expanded="true">
                                                        <i class="la la-ellipsis-h"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                            onclick="editData(' . $row['id'] . ')"><i
                                                                class="la la-ban"></i>
                                                            Laporkan</a>
                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                            onclick="editData(' . $row['id'] . ')"><i
                                                                class="la la-edit"></i>
                                                            Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                            onclick="deleteData(' . $row['id'] . ')"><i
                                                                class="la la-trash"></i> Hapus</a>
                                                    </div>
                                                </span>
                                            </div>
                                            <div class="m-widget3__body">
                                                <p class="m-widget3__text">
                                                    {!! $comment['comment'] !!}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="card-footer">
                            <form class="formComment">
                                <div class="m-widget4">
                                    <div class="m-widget4__item">
                                        <div class="m-widget4__img m-widget4__img--logo">
                                            <img src="{{ session('avatar') }}" alt="">
                                        </div>
                                        <input type="hidden" name="id_discussion" value="{{ $discussion['id'] }}">
                                        <div class="m-widget4__info">
                                            <textarea name="comment" rows="4" class="form-control"></textarea>
                                        </div>
                                        <span class="m-widget4__ext">
                                            <button class="btn btn-success" type="submit">Kirim</button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
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
                            <img src="{{ asset('asset/img/user4.jpg') }}" alt=""
                                class="rounded-circle mr-2 my-auto" height="60">
                            <div class="information">
                                <p class="mb-0">agus susanto melaporakan postingan dari budi susanto</p>
                                <small>1 Jam yang lalu</small>
                            </div>
                        </div>
                        <div class="d-flex mb-2 rounded p-2">
                            <img src="{{ asset('asset/img/user4.jpg') }}" alt=""
                                class="rounded-circle mr-2 my-auto" height="60">
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
    @push('modals')
        <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formUpdate">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id_discussion">
                            <textarea name="content" id="content" rows="4" class="form-control summernote"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="btnUpdate" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endpush
    @push('scripts')
        @include('package.summernote.summernote_js')
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
                        url: '',
                        method: "POST",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(data) {
                            $('#formSubmit').trigger("reset");
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

                $('#formUpdate').on('submit', function(event) {
                    event.preventDefault();
                    $('#btnUpdate').addClass('m-loader m-loader--light m-loader--right');
                    $('#btnUpdate').attr("disabled", true);
                    $.ajax({
                        url: '{{ route('admin.discussion.update') }}',
                        method: "POST",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(data) {
                            window.location.reload();
                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            toastr.error(res.message, "GAGAL");
                            $('#btnUpdate').removeClass('m-loader m-loader--light m-loader--right');
                            $('#btnUpdate').attr("disabled", false);
                        }
                    });
                });

                $('.formComment').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('admin.comment.store') }}',
                        data: $(this).serialize(),
                        success: function(data) {
                            window.location.reload();
                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            toastr.error(res.message, "GAGAL");
                        }
                    })
                })
            });

            function editData(id) {
                $.ajax({
                    url: '{{ route('admin.discussion.detail') }}',
                    data: {
                        id
                    },
                    success: (data) => {
                        $('.modal-title').html('Edit {{ session('title') }}');
                        $('#id_discussion').val(data.id);
                        $('#content').summernote('code', data.content);
                        $('#modalForm').modal('show');
                    }
                });
            }

            function deleteData(id) {
                if (confirm("Apa kamu yakin ingin menghapus data ini?") == true) {
                    $.ajax({
                        url: "{{ route('admin.discussion.delete') }}",
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

            function formSubmit(id_form, btnSubmit, url, modal) {

            }
        </script>
    @endpush
@endsection
