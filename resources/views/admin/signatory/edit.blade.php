@extends('admin.layouts.master')

@section('title', 'Edit Data Penandatangan: '. $signatory->name)

@section('css')
<link href="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<!-- start page title -->
<div class="row align-items-center">
    <div class="col-sm-6">
        @component('admin.components.breadcumb')
        @slot('title') Edit Data Penandatangan: {{ $signatory->name }} @endslot
        @slot('li_1') Penandatangan @endslot
        @endcomponent
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Edit Data Penandatangan: {{ $signatory->name }}</h4>
                <p class="card-title-desc">Silahkan edit dengan benar form dibawah.</p>

                @include('admin.components.message')

                <form class="custom-validation" method="POST"
                    action="{{ route('admin.signatories.update', $signatory->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama *</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="name" id="name"
                                value="{{ old('name') ?? $signatory->name }}" data-parsley-length="[5,255]" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="position" class="col-sm-2 col-form-label">Jabatan *</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="position" id="position"
                                value="{{ old('position') ?? $signatory->position }}" data-parsley-length="[5,255]"
                                required>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                Submit
                            </button>
                            <a class="btn btn-secondary waves-effect waves-light"
                                href="{{ route('admin.signatories.index') }}" role="button">Cancel</a>
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
<script src="{{ URL::asset('assets/libs/parsleyjs/parsleyjs.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/pages/form-validation.init.js')}}"></script>
<script src="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.js')}}"></script>

<script src="{{ URL::asset('assets/js/pages/lightbox.init.js')}}"></script>
@endsection