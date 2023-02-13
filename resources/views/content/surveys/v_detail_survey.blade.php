@extends('content.surveys.v_main')
@section('survey')
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-wrapper">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ session('title') }}
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <a href="#" class="btn btn-accent m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
                        <span>
                            <span>Informasi</span>
                        </span>
                    </a>
                    <a href="javascript:void(0)" onclick="addSurvey({{ $category['id'] }})"
                        class="btn btn-brand m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
                        <span>
                            <span>Add Data</span>
                        </span>
                    </a>

                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <table class="table">
                @if ($surveys->isEmpty())
                    <tr>
                        <td colspan="3" class="text-center align-middle">Pertanyaan belum tersedia</td>
                    </tr>
                @else
                    @foreach ($surveys as $survey)
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{!! $survey['question'] !!}</td>
                            <td class="text-right align-middle">
                                <a href="javascript:void(0)" onclick="deleteSurvey({{ $survey['id'] }})"
                                    class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-1">
                                    <i class="la la-trash"></i>
                                </a>
                                <a href="javascript:void(0)" onclick="editSurvey()"
                                    class="btn btn-primary m-btn m-btn--icon m-btn--icon-only m-1">
                                    <i class="la la-pencil"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif


            </table>
        </div>
    </div>
    @push('modals')
        <div class="modal fade" id="modalSurvey" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formSurvey">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id_survey">
                            <input type="hidden" name="id_category" id="eid_category">
                            <div class="form-group">
                                <label>Pertanyaan</label>
                                <textarea name="question" id="question" rows="3" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Jenis Survey</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="" selected disabled>Pilih Jenis</option>
                                    <option value="option">Pilihan</option>
                                    <option value="teks">Teks</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="btnSurvey" class="btn btn-primary">Save changes</button>
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

                $('#formSurvey').on('submit', function(event) {
                    event.preventDefault();
                    $('#btnSurvey').addClass('m-loader m-loader--light m-loader--right');
                    $('#btnSurvey').attr("disabled", true);
                    $.ajax({
                        url: '{{ route('admin.survey.store') }}',
                        method: "POST",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(data) {
                            window.location.reload();
                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            toastr.error(res.message, "GAGAL");
                            $('#btnSurvey').removeClass('m-loader m-loader--light m-loader--right');
                            $('#btnSurvey').attr("disabled", false);
                        }
                    });
                });
            })

            function addSurvey(id_category) {
                $('#id_survey').val("");
                $('#formSurvey').trigger("reset");
                $('#eid_category').val(id_category);
                $('.modal-title').html("Tambah Survei");
                $('#modalSurvey').modal('show');
            }

            // function editData(id) {
            //     $.ajax({
            //         url: '{{ route('admin.manage.detail') }}',
            //         data: {
            //             id
            //         },
            //         success: (data) => {
            //             $('.modal-title').html('Edit {{ session('title') }}');
            //             $('#id_admin').val(data.id);
            //             $('#name').val(data.name);
            //             $('#email').val(data.email);
            //             $('#phone').val(data.phone);
            //             $('#preview-image').attr('src', data.avatar);
            //             $('#modalForm').modal('show');
            //         }
            //     });
            // }

            function deleteSurvey(id) {
                if (confirm("Apa kamu yakin ingin menghapus data ini?") == true) {
                    $.ajax({
                        url: "{{ route('admin.survey.delete') }}",
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
