@extends('admin.layouts.master')

@section('title', 'Edit Data Warga: ' . $user->name)

@section('content')

<!-- start page title -->
<div class="row align-items-center">
    <div class="col-sm-6">
        @component('admin.components.breadcumb')
        @slot('title') Tambah Data Warga @endslot
        @slot('li_1') Warga @endslot
        @endcomponent
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Tambah Data Warga</h4>
                <p class="card-title-desc">Silahkan isi dengan benar form dibawah.</p>

                @include('admin.components.message')

                <form class="custom-validation" method="POST" action="{{ route('admin.users.update', $user->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label for="photo" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-10">
                            <a class="image-popup-no-margins" href="{{ asset($user->photo) }}">
                                <img class="img-fluid" alt="{{ $user->name }}" src="{{ asset($user->photo) }}"
                                    width="120">
                            </a>
                            <input class="form-control mt-2" type="file" name="photo" id="photo">
                            <p class='help-block'>Please leave empty if not change.</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sin" class="col-sm-2 col-form-label">NIK *</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="sin" id="sin"
                                value="{{ old('sin') ?? $user->sin }}" data-parsley-type="number"
                                data-parsley-length="[16,255]" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama *</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="name" id="name"
                                value="{{ old('name') ?? $user->name }}" data-parsley-length="[5,255]" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="birth_place" class="col-sm-2 col-form-label">Tempat Lahir *</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="birth_place" id="birth_place"
                                value="{{ old('birth_place') ?? $user->birth_place }}" data-parsley-length="[5,255]"
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="birth_date" class="col-sm-2 col-form-label">Tanggal Lahir *</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="date" name="birth_date" id="birth_date"
                                value="{{ old('birth_date') ?? $user->birth_date->format('Y-m-d') }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="religion" class="col-sm-2 col-form-label">Agama</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="religion" id="religion" required>
                                <option selected disabled>Select *</option>
                                <option {{ $user->religion == 'Islam' ? 'selected' : '' }} value="Islam">Islam</option>
                                <option {{ $user->religion == 'Protestan' ? 'selected' : '' }} value="Protestan">
                                    Protestan</option>
                                <option {{ $user->religion == 'Katolik' ? 'selected' : '' }} value="Katolik">Katolik
                                </option>
                                <option {{ $user->religion == 'Hindu' ? 'selected' : '' }} value="Hindu">Hindu</option>
                                <option {{ $user->religion == 'Buddha' ? 'selected' : '' }} value="Buddha">Buddha
                                </option>
                                <option {{ $user->religion == 'Konghucu' ? 'selected' : '' }} value="Konghucu">Konghucu
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gender" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="gender" id="gender" required>
                                <option selected disabled>Select *</option>
                                <option {{ $user->gender == 'Laki - Laki' ? 'selected' : '' }} value="Laki - Laki">Laki
                                    - Laki</option>
                                <option {{ $user->gender == 'Perempuan' ? 'selected' : '' }} value="Perempuan">Perempuan
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea id="address" name="address" class="form-control" maxlength="225"
                                rows="3">{{ old('address') ?? $user->address }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="marital_status" class="col-sm-2 col-form-label">Status Perkawinan</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="marital_status" id="marital_status" required>
                                <option selected disabled>Select *</option>
                                <option {{ $user->marital_status == 'Belum Kawin' ? 'selected' : '' }}
                                    value="Belum Kawin">Belum Kawin</option>
                                <option {{ $user->marital_status == 'Kawin' ? 'selected' : '' }} value="Kawin">Kawin
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="profession" class="col-sm-2 col-form-label">Pekerjaan *</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="profession" id="profession"
                                value="{{ old('profession') ?? $user->profession }}" data-parsley-length="[5,255]"
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone_number" class="col-sm-2 col-form-label">Phone Number</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="phone_number" id="phone_number"
                                value="{{ old('phone_number', $user->phone_number) }}" data-parsley-length="[5,255]" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="password" name="password" id="password"
                                data-parsley-length="[6,255]">
                            <p class='help-block'>Please leave empty if not change.</p>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                Submit
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
<script src="{{ URL::asset('assets/libs/parsleyjs/parsleyjs.min.js')}}"></script>

<script src="{{ URL::asset('assets/js/pages/form-validation.init.js')}}"></script>
@endsection