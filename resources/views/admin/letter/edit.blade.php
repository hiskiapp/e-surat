@extends('admin.layouts.master')

@section('title', 'Edit Surat: ' . $letter->name)

@section('content')

<!-- start page title -->
<div class="row align-items-center">
    <div class="col-sm-6">
        @component('admin.components.breadcumb')
        @slot('title') Edit Surat @endslot
        @slot('li_1') Surat @endslot
        @endcomponent
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Tambah Surat</h4>
                <p class="card-title-desc">Silahkan isi dengan benar form dibawah.</p>

                @include('admin.components.message')

                <form class="custom-validation" method="POST" action="{{ route('admin.letters.update', $letter->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama Surat *</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="name" id="name"
                                value="{{ old('name') ?? $letter->name }}" data-parsley-length="[5,255]" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Status *</label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="status" id="switch3" switch="bool"
                                {{ $letter->status == 'On' ? 'checked' : '' }} />
                            <label for="switch3" data-on-label="On" data-off-label="Off"></label>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                Submit
                            </button>
                            <a class="btn btn-secondary waves-effect waves-light"
                                href="{{ route('admin.letters.index') }}" role="button">Cancel</a>
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
@endsection