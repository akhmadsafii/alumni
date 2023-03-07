@extends('content.auth.layout.v_main')
@section('auth_content')
    <div class="m-wizard m-wizard--1 m-wizard--success" id="m_wizard">

        <!--begin: Message container -->
        <div class="m-portlet__padding-x">

            <!-- Here you can put a message or alert -->
        </div>

        <!--end: Message container -->

        <!--begin: Form Wizard Head -->
        <div class="m-wizard__head m-portlet__padding-x">

            <!--begin: Form Wizard Progress -->
            <div class="m-wizard__progress">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
            </div>

            <!--end: Form Wizard Progress -->

            <!--begin: Form Wizard Nav -->
            <div class="m-wizard__nav">
                <div class="m-wizard__steps">
                    <div class="m-wizard__step m-wizard__step--current" m-wizard-target="m_wizard_form_step_1">
                        <div class="m-wizard__step-info">
                            <a href="#" class="m-wizard__step-number">
                                <span><span>1</span></span>
                            </a>
                            <div class="m-wizard__step-line">
                                <span></span>
                            </div>
                            <div class="m-wizard__step-label">
                                Informasi Detail
                            </div>
                        </div>
                    </div>
                    <div class="m-wizard__step" m-wizard-target="m_wizard_form_step_2">
                        <div class="m-wizard__step-info">
                            <a href="#" class="m-wizard__step-number">
                                <span><span>2</span></span>
                            </a>
                            <div class="m-wizard__step-line">
                                <span></span>
                            </div>
                            <div class="m-wizard__step-label">
                                Selengkapnya
                            </div>
                        </div>
                    </div>
                    <div class="m-wizard__step" m-wizard-target="m_wizard_form_step_3">
                        <div class="m-wizard__step-info">
                            <a href="#" class="m-wizard__step-number">
                                <span><span>3</span></span>
                            </a>
                            <div class="m-wizard__step-line">
                                <span></span>
                            </div>
                            <div class="m-wizard__step-label">
                                Confirmation
                            </div>
                        </div>
                    </div>
                    {{-- <div class="m-wizard__step" m-wizard-target="m_wizard_form_step_4">
                        <div class="m-wizard__step-info">
                            <a href="#" class="m-wizard__step-number">
                                <span><span>4</span></span>
                            </a>
                            <div class="m-wizard__step-line">
                                <span></span>
                            </div>
                            <div class="m-wizard__step-label">
                                Confirmation
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>

            <!--end: Form Wizard Nav -->
        </div>

        <!--end: Form Wizard Head -->

        <!--begin: Form Wizard Form-->
        <div class="m-wizard__form">

            <form class="m-form m-form--label-align-left- m-form--state- formSubmit" id="m_form">
                <div class="m-portlet__body">

                    <!--begin: Form Wizard Step 1-->
                    <div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_1">
                        <div class="row">
                            <div class="col-xl-8 offset-xl-2">
                                <div class="m-form__section m-form__section--first">
                                    <div class="m-form__heading">
                                        <h3 class="m-form__heading-title">Informasi Details</h3>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Nama Lengkap:</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-user"></i></span></div>
                                                <input type="text" name="name" id="name"
                                                    class="form-control m-input" autocomplete="off"
                                                    onkeypress="return getValue(this, 'result-name')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">NIK:</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-circle-thin"></i></span></div>
                                                <input type="text" name="nik" id="nik"
                                                    class="form-control m-input" autocomplete="off"
                                                    onkeypress="return getValue(this, 'result-nik')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Email:</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-envelope"></i></span></div>
                                                <input type="email" name="email" id="email"
                                                    class="form-control m-input" autocomplete="off"
                                                    onkeypress="return getValue(this, 'result-email')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Tempat Lahir</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-map-signs"></i></span></div>
                                                <input type="text" name="place_of_birth" id="place_of_birth"
                                                    class="form-control m-input" autocomplete="off"
                                                    onkeypress="return getValue(this, 'result-place_of_birth')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Tanggal Lahir</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-calendar"></i></span></div>
                                                <input type="text" name="date_of_birth" id="date_of_birth"
                                                    class="form-control m-input m_datetimepicker_6"
                                                    onchange="changeValue(event, 'result-date_of_birth');" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Phone</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-phone"></i></span></div>
                                                <input type="text" name="phone" id="phone"
                                                    class="form-control m-input" autocomplete="off"
                                                    onkeypress="return getValue(this, 'result-phone')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Jurusan</label>
                                        <div class="col-xl-9 col-lg-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="la la-gavel"></i></span>
                                                </div>
                                                <select name="id_major" id="id_major" class="form-control"
                                                    onchange="getChange(this, 'result-major')">
                                                    <option value="" selected disabled>-- Pilih Juruan --</option>
                                                    @foreach ($majors as $major)
                                                        <option value="{{ $major['id'] }}"
                                                            data-key="{{ $major['name'] }}">{{ $major['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end: Form Wizard Step 1-->

                    <!--begin: Form Wizard Step 2-->
                    <div class="m-wizard__form-step" id="m_wizard_form_step_2">
                        <div class="row">
                            <div class="col-xl-8 offset-xl-2">
                                <div class="m-form__section m-form__section--first">
                                    <div class="m-form__heading">
                                        <h3 class="m-form__heading-title">Selengkapnya</h3>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-6 m-form__group-sub">
                                            <label class="form-control-label">Angkatan</label>
                                            <input type="text" name="graduating_class" id="graduating_class"
                                                class="form-control m-input datepickerYear" autocomplete="off" readonly
                                                onchange="return getValue(this, 'result-graduating_class')">
                                        </div>
                                        <div class="col-lg-6 m-form__group-sub">
                                            <label class="form-control-label">Tahun Lulus</label>
                                            <input type="text" name="graduation_year" id="graduation_year"
                                                class="form-control m-input datepickerYear" autocomplete="off"
                                                onchange="return getValue(this, 'result-graduation_year')" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-12">
                                            <label class="form-control-label">Jenis Kelamin</label>
                                            <div class="m-radio-inline">
                                                <label class="m-radio m-radio--solid m-radio--brand">
                                                    <input type="radio" name="gender" checked=""
                                                        data-key="Laki - laki" onclick="checkRadio('result-gender')"
                                                        value="male">
                                                    laki laki
                                                    <span></span>
                                                </label>
                                                <label class="m-radio m-radio--solid m-radio--brand">
                                                    <input type="radio" data-key="Perempuan" name="gender"
                                                        value="female" onclick="checkRadio('result-gender')"> Perempuan
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-12">
                                            <label class="form-control-label">Alamat</label>
                                            <textarea name="address" id="address" rows="3" class="form-control" autocomplete="off"
                                                onkeypress="return getValue(this, 'result-address')"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row py-0">
                                        <div class="col-lg-6 m-form__group-sub py-3">
                                            <label class="form-control-label">Pekerjaan</label>
                                            <input type="text" name="job" id="job"
                                                class="form-control m-input" autocomplete="off"
                                                onkeypress="return getValue(this, 'result-job')">
                                        </div>
                                        <div class="col-lg-6 m-form__group-sub py-3">
                                            <label class="form-control-label">Pekerjaan sesuai jurusan</label>
                                            <select name="corresponding_major" id="corresponding_major"
                                                onchange="getChange(this, 'result-corresponding_major')"
                                                class="form-control">
                                                <option value="" disabled selected>-- Sesuai jurusan? --</option>
                                                <option value="1" data-key="Ya">Ya</option>
                                                <option value="0" data-key="Tidak">Tidak</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 m-form__group-sub py-3">
                                            <label class="form-control-label">Nama Sekolah / Universitas</label>
                                            <input type="text" class="form-control" id="university" name="university"
                                                autocomplete="off"
                                                onkeypress="return getValue(this, 'result-university')">
                                        </div>
                                        <div class="col-lg-6 m-form__group-sub py-3">
                                            <label class="form-control-label">Program Studi / jurusan</label>
                                            <input type="text" class="form-control" name="study_program"
                                                id="study_program" autocomplete="off"
                                                onkeypress="return getValue(this, 'result-study_program')">
                                        </div>
                                        <div class="col-lg-6 m-form__group-sub py-3">
                                            <label class="form-control-label">Bidang Usaha</label>
                                            <input type="text" class="form-control" name="business_field"
                                                id="business_field" autocomplete="off"
                                                onkeypress="return getValue(this, 'result-business_field')">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-12">
                                            <label class="form-control-label">Gambar</label>
                                            <input type="file" name="file" class="form-control-file"
                                                onchange="readURL(this);">
                                        </div>
                                        <div class="col-lg-3">
                                            <img id="preview-image" src="https://via.placeholder.com/150" alt="Preview"
                                                class="w-100 my-1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-wizard__form-step" id="m_wizard_form_step_3">
                        <div class="row">
                            <div class="col-xl-8 offset-xl-2">

                                <!--begin::Section-->
                                <div class="m-accordion m-accordion--default" id="m_accordion_1" role="tablist">

                                    <!--begin::Item-->
                                    <div class="m-accordion__item active">
                                        <div class="m-accordion__item-head" role="tab" id="m_accordion_1_item_1_head"
                                            data-toggle="collapse" href="#m_accordion_1_item_1_body"
                                            aria-expanded="  false">
                                            <span class="m-accordion__item-icon"><i
                                                    class="fa flaticon-user-ok"></i></span>
                                            <span class="m-accordion__item-title">1. Informasi Detail</span>
                                            <span class="m-accordion__item-mode"></span>
                                        </div>
                                        <div class="m-accordion__item-body collapse show" id="m_accordion_1_item_1_body"
                                            class=" " role="tabpanel" aria-labelledby="m_accordion_1_item_1_head"
                                            data-parent="#m_accordion_1">

                                            <!--begin::Content-->
                                            <div class="tab-content  m--padding-30">
                                                <div class="m-form__section m-form__section--first">
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Nama
                                                            Lengkap:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static" id="result-name">-</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">NIK:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static" id="result-nik">-</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Email:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static"
                                                                id="result-email">-</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Tempat
                                                            Lahir:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static"
                                                                id="result-place_of_birth">-</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Tanggal
                                                            Lahir:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static"
                                                                id="result-date_of_birth">-</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Telepon:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static"
                                                                id="result-phone">-</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Jurusan:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static"
                                                                id="result-major">-</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-accordion__item">
                                        <div class="m-accordion__item-head collapsed" role="tab"
                                            id="m_accordion_1_item_2_head" data-toggle="collapse"
                                            href="#m_accordion_1_item_2_body" aria-expanded="false">
                                            <span class="m-accordion__item-icon"><i class="fa  flaticon-user"></i></span>
                                            <span class="m-accordion__item-title">2. Selengkapnya</span>
                                            <span class="m-accordion__item-mode"></span>
                                        </div>
                                        <div class="m-accordion__item-body collapse" id="m_accordion_1_item_2_body"
                                            class=" " role="tabpanel" aria-labelledby="m_accordion_1_item_2_head"
                                            data-parent="#m_accordion_1">

                                            <!--begin::Content-->
                                            <div class="tab-content  m--padding-30">
                                                <div class="m-form__section m-form__section--first">
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Angkatan:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static"
                                                                id="result-graduating_class">-</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Tahun
                                                            Lulus:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static"
                                                                id="result-graduation_year">-</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Jenis
                                                            Kelamin:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static"
                                                                id="result-gender">-</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Alamat:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static"
                                                                id="result-address">-</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Pekerjaan:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static" id="result-job">-</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Pekerjaan Sesuai
                                                            Jurusan:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static"
                                                                id="result-corresponding_major">-</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Nama Sekolah /
                                                            Universitas:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static"
                                                                id="result-university">-</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Program Studi /
                                                            Jurusan:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static"
                                                                id="result-study_program">-</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Bidang
                                                            Usaha:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static"
                                                                id="result-business_field">-</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Avatar:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <img id="image-preview" src="https://via.placeholder.com/150"
                                                                alt="Preview" width="150">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--end::Section-->
                                <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                <div class="form-group m-form__group m-form__group--sm row">
                                    <div class="col-xl-12">
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox m-checkbox--solid m-checkbox--brand">
                                                <input type="checkbox" name="accept" value="1" required>
                                                Klik disini untuk menyetujui syarat dan ketentuan yang
                                                berlaku
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end: Form Wizard Step 3-->

                    <!--begin: Form Wizard Step 4-->
                    {{-- <div class="m-wizard__form-step" id="m_wizard_form_step_4">
                        <div class="row">
                            <div class="col-xl-8 offset-xl-2">

                                <!--begin::Section-->
                                <div class="m-accordion m-accordion--default" id="m_accordion_1" role="tablist">

                                    <!--begin::Item-->
                                    <div class="m-accordion__item active">
                                        <div class="m-accordion__item-head" role="tab" id="m_accordion_1_item_1_head"
                                            data-toggle="collapse" href="#m_accordion_1_item_1_body"
                                            aria-expanded="  false">
                                            <span class="m-accordion__item-icon"><i
                                                    class="fa flaticon-user-ok"></i></span>
                                            <span class="m-accordion__item-title">1. Client Information</span>
                                            <span class="m-accordion__item-mode"></span>
                                        </div>
                                        <div class="m-accordion__item-body collapse show" id="m_accordion_1_item_1_body"
                                            class=" " role="tabpanel" aria-labelledby="m_accordion_1_item_1_head"
                                            data-parent="#m_accordion_1">

                                            <!--begin::Content-->
                                            <div class="tab-content  m--padding-30">
                                                <div class="m-form__section m-form__section--first">
                                                    <div class="m-form__heading">
                                                        <h4 class="m-form__heading-title">Account Details</h4>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">URL:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span
                                                                class="m-form__control-static">sinortech.vertoffice.com</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Username:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static">sinortech.admin</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Password:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static">*********</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                                <div class="m-form__section">
                                                    <div class="m-form__heading">
                                                        <h4 class="m-form__heading-title">Client Settings</h4>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">User Group:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static">Customer</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label
                                                            class="col-xl-4 col-lg-4 col-form-label">Communications:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static">Phone, Email</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--end::Content-->
                                        </div>
                                    </div>

                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <div class="m-accordion__item">
                                        <div class="m-accordion__item-head collapsed" role="tab"
                                            id="m_accordion_1_item_2_head" data-toggle="collapse"
                                            href="#m_accordion_1_item_2_body" aria-expanded="    false">
                                            <span class="m-accordion__item-icon"><i
                                                    class="fa  flaticon-placeholder"></i></span>
                                            <span class="m-accordion__item-title">2. Account Setup</span>
                                            <span class="m-accordion__item-mode"></span>
                                        </div>
                                        <div class="m-accordion__item-body collapse" id="m_accordion_1_item_2_body"
                                            class=" " role="tabpanel" aria-labelledby="m_accordion_1_item_2_head"
                                            data-parent="#m_accordion_1">

                                            <!--begin::Content-->
                                            <div class="tab-content  m--padding-30">
                                                <div class="m-form__section m-form__section--first">
                                                    <div class="m-form__heading">
                                                        <h4 class="m-form__heading-title">Account Details</h4>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">URL:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span
                                                                class="m-form__control-static">sinortech.vertoffice.com</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Username:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static">sinortech.admin</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Password:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static">*********</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                                <div class="m-form__section">
                                                    <div class="m-form__heading">
                                                        <h4 class="m-form__heading-title">Client Settings</h4>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">User Group:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static">Customer</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label
                                                            class="col-xl-4 col-lg-4 col-form-label">Communications:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static">Phone, Email</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--end::Content-->
                                        </div>
                                    </div>

                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <div class="m-accordion__item">
                                        <div class="m-accordion__item-head collapsed" role="tab"
                                            id="m_accordion_1_item_3_head" data-toggle="collapse"
                                            href="#m_accordion_1_item_3_body" aria-expanded="    false">
                                            <span class="m-accordion__item-icon"><i
                                                    class="fa  flaticon-alert-2"></i></span>
                                            <span class="m-accordion__item-title">3. Billing Setup</span>
                                            <span class="m-accordion__item-mode"></span>
                                        </div>
                                        <div class="m-accordion__item-body collapse" id="m_accordion_1_item_3_body"
                                            class=" " role="tabpanel" aria-labelledby="m_accordion_1_item_3_head"
                                            data-parent="#m_accordion_1">
                                            <div class="tab-content  m--padding-30">
                                                <div class="m-form__section m-form__section--first">
                                                    <div class="m-form__heading">
                                                        <h4 class="m-form__heading-title">Billing Information</h4>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Cardholder
                                                            Name:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static">Nick Stone</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Card
                                                            Number:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static">*************4589</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Exp Month:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static">10</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Exp Year:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static">2018</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">CVV:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static">***</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                                <div class="m-form__section">
                                                    <div class="m-form__heading">
                                                        <h4 class="m-form__heading-title">Billing Address</h4>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Address Line
                                                            1:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static">Headquarters 1120 N Street
                                                                Sacramento 916-654-5266</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Address Line
                                                            2:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static">P.O. Box 942873
                                                                Sacramento, CA 94273-0001</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">City:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static">Polo Alto</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">State:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static">California</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">ZIP:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static">37505</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group m-form__group--sm row">
                                                        <label class="col-xl-4 col-lg-4 col-form-label">Country:</label>
                                                        <div class="col-xl-8 col-lg-8">
                                                            <span class="m-form__control-static">USA</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--end::Item-->
                                </div>

                                <!--end::Section-->
                                <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                <div class="form-group m-form__group m-form__group--sm row">
                                    <div class="col-xl-12">
                                        <div class="m-checkbox-inline">
                                            <label class="m-checkbox m-checkbox--solid m-checkbox--brand">
                                                <input type="checkbox" name="accept" value="1">
                                                Click here to indicate that you have read and agree to the terms presented
                                                in the Terms and Conditions agreement
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <!--end: Form Wizard Step 4-->
                </div>

                <!--end: Form Body -->

                <!--begin: Form Actions -->
                <div class="m-portlet__foot m-portlet__foot--fit m--margin-top-40">
                    <div class="m-form__actions m-form__actions">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 m--align-left">
                                <button class="btn btn-secondary m-btn m-btn--custom m-btn--icon"
                                    data-wizard-action="prev">
                                    <span>
                                        <i class="la la-arrow-left"></i>&nbsp;&nbsp;
                                        <span>Back</span>
                                    </span>
                                </button>
                            </div>
                            <div class="col-lg-4 m--align-right">
                                <button class="btn btn-primary m-btn m-btn--custom m-btn--icon"
                                    data-wizard-action="submit" type="submit" id="btnSubmit">
                                    <span>
                                        <i class="la la-check"></i>&nbsp;&nbsp;
                                        <span>Submit</span>
                                    </span>
                                </button>
                                <button class="btn btn-warning m-btn m-btn--custom m-btn--icon" data-wizard-action="next">
                                    <span>
                                        <span>Save & Continue</span>&nbsp;&nbsp;
                                        <i class="la la-arrow-right"></i>
                                    </span>
                                </button>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions text-center">
                        <span>Sudah punya akun?</span>
                        <a href="{{ route('auth.login') }}" class="m-link m--font-danger">Sign in</a>
                    </div>
                </div>

                <!--end: Form Actions -->
            </form>
        </div>

        <!--end: Form Wizard Form-->
    </div>

    <!--end: Form Wizard-->
    @push('scripts_js')
        @include('package.datetimepicker.datetimepicker_js')
        @include('package.wizard.wizard_js')
        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                let gender = 'Laki - laki';
                $('#result-gender').html(gender);

                $('.formSubmit').on('submit', function(event) {
                    event.preventDefault();
                    $('#btnSubmit').addClass('m-loader m-loader--light m-loader--right');
                    $('#btnSubmit').attr("disabled", true);
                    var formData = new FormData(this);
                    $.ajax({
                        type: "POST",
                        url: '{{ route('auth.verify_register') }}',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            swal({
                                title: "",
                                text: data.message,
                                type: "success",
                                confirmButtonClass: "btn btn-secondary m-btn m-btn--wide",
                            });
                            window.location.href = "{{ route('auth.login') }}";
                        },
                        error: function(data) {
                            const res = data.responseJSON;
                            toastr.error(res.message, "GAGAL");
                            $('#btnSubmit').removeClass('m-loader m-loader--light m-loader--right');
                            $('#btnSubmit').attr("disabled", false);
                        }
                    });
                });

                jQuery('.datepickerYear').datepicker({
                    format: "yyyy",
                    viewMode: "years",
                    minViewMode: "years",
                    language: "id",
                    autoclose: true,
                });
            });

            function readURL(input, id) {
                id = id || '#preview-image';
                if (input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(id).attr('src', e.target.result);
                        $('#image-preview').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            function getValue(evt, key) {
                let dInput = evt.value;
                console.log(dInput);
                $('#' + key).html(dInput);
                return true;
            }

            function changeValue(e, key) {
                let dInput = e.target.value;
                console.log(dInput);
                $('#' + key).html(dInput);
                return true;
            }

            function getChange(x, target) {
                let dInput = $(x).find(":selected").attr("data-key");
                // console.log(dInput);
                $('#' + target).html(dInput);
                return true;
            }

            function checkRadio(target) {

                gender = $("input[name=gender]:checked").attr('data-key');
                $('#' + target).html(gender);
                return true;
            }
        </script>
    @endpush
@endsection
