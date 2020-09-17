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
                        <label for="leftlogo" class="col-sm-2 col-form-label">Logo Kiri</label>
                        <div class="col-sm-10">
                            <a class="image-popup-no-margins" href="{{ asset(setting('leftlogo')) }}">
                                <img class="img-fluid" alt="@setting('village')" src="{{ asset(setting('leftlogo')) }}"
                                    width="120">
                            </a>
                            <input class="form-control mt-2" type="file" name="leftlogo" id="leftlogo">
                            <p class='help-block'>Please leave empty if not change.</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rightlogo" class="col-sm-2 col-form-label">Logo Kanan</label>
                        <div class="col-sm-10">
                            <a class="image-popup-no-margins" href="{{ asset(setting('rightlogo')) }}">
                                <img class="img-fluid" alt="@setting('village')" src="{{ asset(setting('rightlogo')) }}"
                                    width="120">
                            </a>
                            <input class="form-control mt-2" type="file" name="rightlogo" id="rightlogo">
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
                        <label for="address" class="col-sm-2 col-form-label">Alamat *</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="address">{{ setting('address') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="postal_code" class="col-sm-2 col-form-label">Kode Pos *</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="postal_code" id="postal_code"
                                value="@setting('postal_code')" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="website" class="col-sm-2 col-form-label">Website *</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="website" id="website"
                                value="@setting('website')" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="signatory_active" class="col-sm-2 col-form-label">Penandatangan Surat *</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="signatory_active" id="signatory_active" required>
                                <option selected disabled>Select *</option>
                                @foreach($signatories as $signatory)
                                <option value="{{ $signatory->id }}"
                                    {{ $signatory->id == setting('signatory_active') ? 'selected' : '' }}>
                                    {{ $signatory->name }} - {{ $signatory->position }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="whatsapp" class="col-sm-2 col-form-label">Whatsapp (Untuk Notifikasi) *</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="whatsapp" id="whatsapp"
                                value="@setting('whatsapp')" required>
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