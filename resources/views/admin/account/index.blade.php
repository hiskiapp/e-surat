@extends('admin.layouts.master')

@section('title', 'Data Akun')

@section('css')
<link href="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<!-- start page title -->
<div class="row align-items-center">
    <div class="col-sm-6">
        @component('admin.components.breadcumb')
        @slot('title') Data Akun @endslot
        @slot('li_1') Admin @endslot
        @endcomponent
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Data Akun</h4>
                <p class="card-title-desc">Silahkan edit dengan benar form dibawah.</p>

                @include('admin.components.message')

                <form class="custom-validation" method="POST" action="{{ route('admin.account') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">Username *</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="username" id="username"
                                value="{{ $admin->username }}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="photo" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-10">
                            <a class="image-popup-no-margins" href="{{ asset($admin->photo) }}">
                                <img class="img-fluid" alt="{{ $admin->name }}" src="{{ asset($admin->photo) }}"
                                    width="120">
                            </a>
                            <input class="form-control mt-2" type="file" name="photo" id="photo">
                            <p class='help-block'>Please leave empty if not change.</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama *</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="name" id="name"
                                value="{{ old('name') ?? $admin->name }}" data-parsley-length="[5,255]" required>
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