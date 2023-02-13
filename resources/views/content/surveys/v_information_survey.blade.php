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
                    <ul class="nav nav-tabs m-tabs m-tabs-line  m-tabs-line--right" role="tablist">
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link active" data-toggle="tab" href="#summary" role="tab">
                                Ringkasan
                            </a>
                        </li>
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#statistic" role="tab">
                                Statistik
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="tab-content">
                <div class="tab-pane active" id="summary" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="bg-secondary">
                                <tr>
                                    <th class="align-middle">No</th>
                                    <th class="align-middle">Pertanyaan</th>
                                    @foreach (Helper::option_array() as $option)
                                        <th class="text-center align-middle">{{ $option }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Panduan penggunaan laboratorium telah disediakan dengan baik</td>
                                    <td>4</td>
                                    <td>3</td>
                                    <td>6</td>
                                    <td>5</td>
                                    <td>9</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="statistic" role="tabpanel">
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer
                    took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry. Lorem Ipsum has been
                    the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type
                    and scrambled.
                </div>
            </div>
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
                        url: '',
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

            function editSurvey(id) {
                $.ajax({
                    url: '',
                    data: {
                        id
                    },
                    success: (data) => {
                        $('.modal-title').html(
                            'Edit {{ session('
                                                                        title ') }}');
                        $('#id_survey').val(data.id);
                        $('#question').val(data.question);
                        $('#type').val(data.type).trigger('change');
                        $('#eid_category').val(data.id_category);
                        $('#modalSurvey').modal('show');
                    }
                });
            }

            function deleteSurvey(id) {
                if (confirm("Apa kamu yakin ingin menghapus data ini?") == true) {
                    $.ajax({
                        url: "",
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
