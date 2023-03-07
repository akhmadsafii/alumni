@extends('content.auth.layout.v_main')
@section('auth_content')
    <div class="m-login__head">
        <span>Don't have an account?</span>
        <a href="{{ route('auth.register') }}" class="m-link m--font-danger">Sign Up</a>
    </div>
    <div class="m-login__body">
        <div class="m-login__signin">
            <div class="m-login__title">
                <h3>{{ session('title') }}</h3>
            </div>
            <form class="m-login__form m-form" id="formLogin">
                <div class="form-group m-form__group">
                    <input class="form-control m-input" type="text" placeholder="Username" name="username"
                        autocomplete="off">
                </div>
                <div class="form-group m-form__group">
                    <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password"
                        name="password">
                </div>
            </form>
            <div class="m-login__action">
                <a href="#" class="m-link">
                    <span>Forgot Password ?</span>
                </a>
                <a href="javascript:void(0)">
                    <button id="btnSubmit"
                        class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">Sign
                        In</button>
                </a>
            </div>
            <div class="m-login__form-divider">
                <div class="m-divider">
                    <span></span>
                    <span>OR</span>
                    <span></span>
                </div>
            </div>
            <div class="m-login__options">
                <a href="#" class="btn btn-primary m-btn m-btn--pill  m-btn  m-btn m-btn--icon">
                    <span>
                        <i class="fab fa-facebook-f"></i>
                        <span>Facebook</span>
                    </span>
                </a>
                <a href="#" class="btn btn-info m-btn m-btn--pill  m-btn  m-btn m-btn--icon">
                    <span>
                        <i class="fab fa-twitter"></i>
                        <span>Twitter</span>
                    </span>
                </a>
                <a href="#" class="btn btn-danger m-btn m-btn--pill  m-btn  m-btn m-btn--icon">
                    <span>
                        <i class="fab fa-google"></i>
                        <span>Google</span>
                    </span>
                </a>
            </div>
        </div>
    </div>
    @push('scripts_js')
        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#btnSubmit').click(function() {
                    $('#formLogin').submit();
                });

                $('#formLogin').on('submit', function(event) {
                    event.preventDefault();
                    $("#btnSubmit").addClass('m-loader m-loader--light m-loader--right');
                    $("#btnSubmit").attr("disabled", true);
                    $.ajax({
                        url: "{{ route('auth.verify_login') }}",
                        method: "POST",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(data) {
                            // console.log(data);
                            if (data.status == true) {
                                swal("Login Berhasil!", data.message, "success")
                                window.location.href = data.target_url
                            } else {
                                swal("Login Gagal!", data.message, "error")
                                $('#btnSubmit').removeClass(
                                    'm-loader m-loader--light m-loader--right');
                                $("#btnSubmit").attr("disabled", false);
                            }

                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            toastr.error(res.message, "GAGAL");
                            console.log(data);
                            $('#btnSubmit').removeClass('m-loader m-loader--light m-loader--right');
                            $("#btnSubmit").attr("disabled", false);
                        }
                    });
                });
            })
        </script>
    @endpush
@endsection
