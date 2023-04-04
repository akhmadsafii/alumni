@extends('layout.guest.v_main')
@section('content')
    @push('styles')
        <style>
            #header {
                background: rgba(39, 70, 133, 0.8);
            }

            .avatar-upload {
                position: relative;
                width: 125px;
                height: 125px;
                margin: auto;
                margin-bottom: 20px;
            }

            .avatar-edit {
                position: absolute;
                right: 0;
                bottom: 0;
                z-index: 1;
            }

            input[type=file].visually-hidden {
                position: absolute;
                left: -9999px;
                width: 1px;
                height: 1px;
                overflow: hidden;
            }

            .avatar-preview {
                width: 100%;
                height: 100%;
                border-radius: 100%;
                overflow: hidden;
            }

            .avatar-preview img {
                display: block;
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .btn-circle {
                display: inline-flex;
                justify-content: center;
                align-items: center;
                width: 40px;
                height: auto;
                border-radius: 50%;
                background-color: #fff;
                border: 1px solid #d2d6de;
                box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
                transition: all .2s ease-in-out;
                cursor: pointer;
            }

            .btn-circle:hover {
                background-color: #f1f1f1;
                border-color: #d6d6d6;
            }
        </style>
    @endpush
    <section class="section">
        <div class="container">
            <form id="general-info" action="{{ route('profile.update_user') }}" method="POST" class="general-info"
                enctype="multipart/form-data">
                @csrf
                <div class="info">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg"
                                                class="visually-hidden" />
                                            <label for="imageUpload" class="btn btn-link btn-sm btn-circle">
                                                <i class="bi bi-upload"></i>
                                            </label>
                                        </div>
                                        <div class="avatar-preview">
                                            <img class="rounded-circle" id="imagePreview"
                                                src="https://adminlte.io/themes/AdminLTE/dist/img/user3-128x128.jpg"
                                                alt="User profile picture">
                                        </div>
                                    </div>
                                    <h5 class="card-title mb-0">John Doe</h5>
                                    <p class="card-text text-muted">Web Developer</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">General Information</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="fullName" class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ old('name', $user->name) }}">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="dob" class="form-label">NIK</label>
                                                <input type="text" class="form-control" id="nik" name="nik"
                                                    value="{{ old('nik', $user->nik) }}">
                                                @error('nik')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="fullName" class="form-label">Tempat Lahir</label>
                                                <input type="text" class="form-control" name="place_of_birth"
                                                    value="{{ old('place_of_birth', $user->place_of_birth) }}">
                                                @error('place_of_birth')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="dob" class="form-label">Tanggal lahir</label>
                                                <input type="date" class="form-control" name="date_of_birth"
                                                    value="{{ old('date_of_birth', $user->date_of_birth) }}">
                                                @error('date_of_birth')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ old('email', $user->email) }}">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone Number</label>
                                                <input type="text" class="form-control" id="phone" name="phone"
                                                    value="{{ old('phone', $user->phone) }}">
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Jenis Kelamin</label>
                                                <select name="gender" class="form-select">
                                                    <option value="" selected disabled>-- Pilih Jenis Kelamin --
                                                    </option>
                                                    <option value="male"
                                                        {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>
                                                        Laki - laki</option>
                                                    <option value="female"
                                                        {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>
                                                        Perempuan</option>
                                                </select>
                                                @error('gender')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Jurusan</label>
                                                <select name="id_major" class="form-select">
                                                    <option value="" selected disabled>-- Pilih Jurusan --</option>
                                                    @foreach ($majors as $major)
                                                        <option value="{{ $major->id }}"
                                                            {{ old('id_major', $user->id_major) == $major->id ? 'selected' : '' }}>
                                                            {{ $major->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('id_major')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Angkatan</label>
                                                <input type="text" name="graduating_class" class="form-control"
                                                    value="{{ old('graduating_class', $user->graduating_class) }}">
                                                @error('graduating_class')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Tahun Lulus</label>
                                                <input type="text" name="graduation_year" class="form-control"
                                                    value="{{ old('graduation_year', $user->graduation_year) }}">
                                                @error('graduation_year')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Alamat</label>
                                                <textarea class="form-control" name="address" id="address" rows="3">{{ old('address', $user->address) }}</textarea>
                                                @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Pekerjaan</label>
                                                <input type="text" name="job" class="form-control"
                                                    value="{{ old('job', $user->job) }}">
                                                @error('job')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Pekerjaan sesuai jurusan</label>
                                                <select name="corresponding_major" class="form-control">
                                                    <option value="" selected disabled>Sesuai Jurusan ?</option>
                                                    <option value="1"
                                                        {{ old('corresponding_major', $user->corresponding_major) == 1 ? 'selected' : '' }}>
                                                        Ya</option>
                                                    <option value="0"
                                                        {{ old('corresponding_major', $user->corresponding_major) == 0 ? 'selected' : '' }}>
                                                        Tidak</option>
                                                </select>
                                                @error('corresponding_major')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Nama Sekolah /
                                                    Universitas</label>
                                                <input type="text" name="university" class="form-control"
                                                    value="{{ old('university', $user->university) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Program Studi / jurusan</label>
                                                <input type="text" name="study_program" class="form-control"
                                                    value="{{ old('study_program', $user->study_program) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Bidang Usaha</label>
                                                <input type="text" name="business_field" class="form-control"
                                                    value="{{ old('business_field', $user->business_field) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    @push('scripts')
        <script>
            $(function() {
                $('#imageUpload').change(function() {
                    var url = $(this).val();
                    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                    if (this.files && this.files[0] && (ext == "png" || ext == "jpeg" || ext == "jpg")) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#imagePreview').attr('src', e.target.result);
                            $('.avatar-preview').css('background-image', 'url(' + e.target.result + ')');
                        }

                        reader.readAsDataURL(this.files[0]);
                    } else {
                        $('#imagePreview').attr('src',
                            'https://adminlte.io/themes/AdminLTE/dist/img/user3-128x128.jpg');
                        $('.avatar-preview').css('background-image',
                            'url(https://adminlte.io/themes/AdminLTE/dist/img/user3-128x128.jpg)');
                    }
                });
            })
        </script>
    @endpush
@endsection
