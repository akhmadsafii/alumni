@extends('layout.guest.v_main')
@section('content')
    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css"
            integrity="sha512-ngQ4IGzHQ3s/Hh8kMyG4FC74wzitukRMIcTOoKT3EyzFZCILOPF0twiXOQn75eDINUfKBYmzYn2AA8DkAk8veQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                            <h1 data-aos="fade-up" data-aos-delay="" class="aos-init aos-animate">Diskusi</h1>
                            <p class="mt-3">media diskusi online yang dapat diakses tanpa dibatasi ruang dan waktu.
                                Melalui forum, Para alumni dapat berdiskusi satu sama lain mengenai suatu topik yang
                                dimoderasi oleh
                                moderator sehingga diskusi berjalan secara kondusif.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row px-3">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body d-flex">
                            <img alt="..." src="{{ session('avatar') }}" class="avatar avatar-sm rounded-circle me-2"
                                height="50">
                            <textarea name="" class="form-control" readonly onclick="showInput()" rows="4" style="border-radius: 15px"></textarea>
                            <button class="btn btn-success btn-sm ms-2">Kirim</button>
                        </div>
                    </div>
                    @foreach ($discussions as $discussion)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-2">
                                            <img class="rounded-circle" width="45" src="{{ $discussion['avatar'] }}"
                                                alt="">
                                        </div>
                                        <div class="ml-2">
                                            <div class="h5 m-0">{{ $discussion['user'] }}</div>
                                            <div class="h7 text-muted">{{ $discussion['created_at'] }}
                                            </div>
                                        </div>
                                    </div>
                                    @if (session('role') == $discussion['role'] && session('id') == $discussion['id_user'])
                                        <div>
                                            <div class="dropdown">
                                                <button class="btn btn-link dropdown-toggle" type="button"
                                                    id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fa fa-ellipsis-h"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li><a class="dropdown-item" href="javascript:void(0)"
                                                            onclick="editDiscussion({{ $discussion['id'] }})">Edit</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0)"
                                                            onclick="deleteDiscussion({{ $discussion['id'] }})">Hapus</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <p class="card-text text-muted">{!! $discussion['content'] !!}</p>
                            </div>
                            <div class="card-footer bg-transparent">
                                <a class="float-end" data-bs-toggle="collapse" href="#collapse_{{ $discussion['id'] }}"
                                    role="button" aria-expanded="false" aria-controls="collapse_{{ $discussion['id'] }}">
                                    {{ $discussion['amount_comments'] }} Komentar
                                </a>
                            </div>
                            <div class="collapse" id="collapse_{{ $discussion['id'] }}">
                                <form id="formComment_{{ $discussion['id'] }}" action="javascript:void(0)">
                                    <div class="card-footer d-flex">
                                        <img alt="..." src="{{ session('avatar') }}"
                                            class="avatar avatar-sm rounded-circle me-2" height="50">
                                        <input type="hidden" name="id_discussion" value="{{ $discussion['id'] }}">
                                        <textarea name="comment" class="form-control" rows="4" style="border-radius: 15px"></textarea>
                                        <button class="btn btn-info btn-sm ms-2 btnComment"
                                            data-id="{{ $discussion['id'] }}">komentar</button>
                                    </div>
                                </form>
                                @foreach ($discussion['comments'] as $comment)
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <img alt="..." src="{{ session('avatar') }}"
                                                class="avatar avatar-sm rounded-circle me-2" height="50">
                                            <div class="card-body bg-light">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="h5 m-0">{{ $comment['user'] }}</div>
                                                    @if (session('role') == $comment['role'] && session('id') == $comment['id_user'])
                                                        @if ($comment['status'] != 0)
                                                            <div>
                                                                <div class="dropdown">
                                                                    <button class="btn btn-link dropdown-toggle"
                                                                        type="button" id="dropdownMenuButton1"
                                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="fa fa-ellipsis-h"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu"
                                                                        aria-labelledby="dropdownMenuButton1">
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0)"
                                                                                onclick="editComment({{ $comment['id'] }})">Edit</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0)"
                                                                                onclick="deleteComment({{ $comment['id'] }})">Hapus</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="h7 text-muted">
                                                    {{ $comment['created_at'] }}
                                                </div>
                                                @if ($comment['status'] == 0)
                                                    <p class="card-text text-muted fst-italic"> <i
                                                            class="bi bi-exclamation-circle"></i> Komentar telah dihapus
                                                    </p>
                                                @else
                                                    <p class="card-text text-muted">{!! $comment['comment'] !!}</p>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    {!! $discussions->render() !!}
                </div>
            </div>
        </div>
    </section>
    @push('modals')
        <div class="modal fade" id="modalForm" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="formSubmit">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id_discussion">
                            <div class="form-group">
                                <textarea name="content" id="content" required class="form-control summernote"></textarea>
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
        <div class="modal fade" id="modalComment" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="formComment">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id_comment">
                            <input type="hidden" name="id_discussion" id="id_comment_discuss">
                            <div class="form-group">
                                <textarea name="comment" id="comment" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="SubmitComment" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endpush
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js"
            integrity="sha512-6rE6Bx6fCBpRXG/FWpQmvguMWDLWMQjPycXMr35Zx/HRD9nwySZswkkLksgyQcvrpYMx0FELLJVBvWFtubZhDQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                $('#modalForm').on('shown.bs.modal', function() {
                    $('.summernote').summernote();
                })

                $('#formSubmit').on('submit', function(event) {
                    event.preventDefault();
                    $('#btnSubmit').attr("disabled", true);
                    $.ajax({
                        url: '{{ route('admin.discussion.store') }}',
                        method: "POST",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(data) {
                            window.location.reload();
                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            console.log(res.message)
                            $('#SubmitComment').attr("disabled", false);
                        }
                    });
                });

                $('#formComment').on('submit', function(event) {
                    event.preventDefault();
                    $('#SubmitComment').attr("disabled", true);
                    $.ajax({
                        url: '{{ route('admin.comment.store') }}',
                        method: "POST",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(data) {
                            window.location.reload();
                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            console.log(res.message)
                            $('#SubmitComment').attr("disabled", false);
                        }
                    });
                });

                $(document).on('click', '.btnComment', function() {
                    var id_post = $(this).data('id');
                    addComment(id_post)
                })
            })

            function addComment(id) {
                var formData = $('#formComment_' + id).serialize();
                $.ajax({
                    url: "{{ route('admin.comment.store') }}",
                    type: 'POST',
                    datatype: 'json',
                    data: formData,
                    success: function(data) {
                        window.location.reload();
                    },
                    error: function(data) {
                        const res = data.responseJSON;
                        console.log(res.message);
                        $(btnSubmit).attr("disabled", false);
                    }
                });
            }


            function showInput() {
                $('#formSubmit').trigger("reset");
                $('.modal-title').html("Tambah {{ session('title') }}");
                $('#modalForm').modal('show');
            }

            function editDiscussion(id) {
                $.ajax({
                    url: "{{ route('admin.discussion.detail') }}",
                    data: {
                        id
                    },
                    success: function(data) {
                        // console.log(data);
                        $('.modal-title').html('Edit {{ session('title') }}');
                        $('#id_discussion').val(data.id);
                        $('#content').summernote('code', data.content);
                        $('#modalForm').modal('show');
                    },
                    error: function(data) {
                        const res = data.responseJSON;
                        console.log(res.message);
                    }
                })
            }

            function deleteDiscussion(id) {
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
                            console.log(res.message);
                        }
                    })
                }
            }

            function editComment(id) {
                $.ajax({
                    url: "{{ route('admin.comment.detail') }}",
                    data: {
                        id
                    },
                    success: function(data) {
                        console.log(data);
                        $('.modal-title').html('Edit Komentar');
                        $('#id_comment').val(data.id);
                        $('#id_comment_discuss').val(data.id_discussion);
                        $('#comment').val(data.comment);
                        $('#modalComment').modal('show');
                    },
                    error: function(data) {
                        const res = data.responseJSON;
                        console.log(res.message);
                    }
                })
            }

            function deleteComment(id) {
                if (confirm("Apa kamu yakin ingin menghapus komentar ini?") == true) {
                    $.ajax({
                        url: "{{ route('admin.comment.delete') }}",
                        data: {
                            id
                        },
                        success: function(data) {
                            window.location.reload();
                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            console.log(res.message);
                        }
                    })
                }
            }
        </script>
    @endpush
@endsection
