@extends('admin.layouts.master')

@section('title', 'Pengaturan')

@section('css')
<link href="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<!-- start page title -->
<div class="row align-items-center">
    <div class="col-sm-6">
        @component('admin.components.breadcumb')
        @slot('title') Pengaturan @endslot
        @slot('li_1') Admin @endslot
        @endcomponent
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Pengaturan</h4>
                <p class="card-title-desc">Silahkan edit dengan benar form dibawah.</p>

                @include('admin.components.message')

                <form class="custom-validation" method="POST" action="{{ route('admin.settings') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label for="logo" class="col-sm-2 col-form-label">Logo</label>
                        <div class="col-sm-10">
                            <a class="image-popup-no-margins" href="{{ asset(setting('logo')) }}">
                                <img class="img-fluid" alt="@setting('village')" src="{{ asset(setting('logo')) }}"
                                    width="120">
                            </a>
                            <input class="form-control mt-2" type="file" name="logo" id="logo">
                            <p class='help-block'>Please leave empty if not change.</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="districts" class="col-sm-2 col-form-label">Kabupaten *</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="districts" id="districts"
                                value="@setting('districts')" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sub-districts" class="col-sm-2 col-form-label">Kecamatan *</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="sub-districts" id="sub-districts"
                                value="@setting('sub-districts')" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="village" class="col-sm-2 col-form-label">Desa *</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="village" id="village"
                                value="@setting('village')" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="village_head" class="col-sm-2 col-form-label">Nama Kepala Desa *</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="village_head" id="village_head"
                                value="@setting('village_head')" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="secretary" class="col-sm-2 col-form-label">Nama Sekretaris *</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="secretary" id="secretary"
                                value="@setting('secretary')" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="vh_status" class="col-sm-2 col-form-label">Status Kepala Desa</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="vh_status" id="vh_status" required>
                                <option selected disabled>Select *</option>
                                <option {{ setting('vh_status') == 'On' ? 'selected' : '' }} value="On">Hadir</option>
                                <option {{ setting('vh_status') == 'Off' ? 'selected' : '' }} value="Off">Tidak Hadir
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="header_down" class="col-sm-2 col-form-label">KOP Bawah *</label>
                        <div class="col-sm-10">
                        <textarea class="form-control" name="header_down">{{ setting('header_down') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                Update
                            </button>
                            <a class="btn btn-secondary waves-effect waves-light" href="{{ route('admin.data.index') }}"
                                role="button">Cancel</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection

@section('script')
<!-- Plugins js -->
<script src="{{ URL::asset('assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>
<script src="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.js') }}"></script>

<script src="{{ URL::asset('assets/js/pages/lightbox.init.js') }}"></script>
@endsection