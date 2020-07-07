@extends('admin.layouts.master')

@section('title') Ganti Password @endsection

@section('content')

<div class="row align-items-center">
    <div class="col-sm-6">
        @component('admin.components.breadcumb')
        @slot('title') Ganti Password @endslot
        @slot('li_1') Akun @endslot
        @endcomponent
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Password</h4>
                <p class="card-title-desc">Silahkan Isi Form Berikut Dengan Benar.</p>
                @include('components.message')
                <form action="{{ route('admin.account.password') }}" method="POST" class="custom-validation">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label for="current_password" class="col-md-2 col-form-label">Current Password</label>
                        <div class="col-md-10">
                            <input class="form-control" type="password" name="current_password" id="current_password"
                                data-parsley-length="[6,255]" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="new_password" class="col-md-2 col-form-label">New Password</label>
                        <div class="col-md-10">
                            <input class="form-control" type="password" name="new_password" id="new_password"
                                data-parsley-length="[6,255]" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="new_confirm_password" class="col-md-2 col-form-label">New Confirm Password</label>
                        <div class="col-md-10">
                            <input class="form-control" type="password" name="new_confirm_password"
                                id="new_confirm_password" data-parsley-length="[6,255]" required>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
            </div>
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>

@endsection

@section('script')
<!-- Plugins js -->
<script src="{{ URL::asset('assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>
@endsection