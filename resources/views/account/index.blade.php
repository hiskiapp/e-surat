@extends('layouts.master')

@section('title', 'Data Diri: ' . $user->name)

@section('css')
<link href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<!-- start page title -->
<div class="row align-items-center">
    <div class="col-sm-6">
        @component('components.breadcumb')
        @slot('title') Data Diri: {{ $user->name }} @endslot
        @slot('li_1') Home @endslot
        @endcomponent
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Nomor Whatsapp</h4>
                <p class="card-title-desc">Dapatkan pemberitahun mengenai pengajuan surat melalui Whatsapp. ex: 6281234567890 (jika format salah, pesan tidak akan terkirim)</p>

                @include('components.message')

                <form class="custom-validation" method="POST" action="{{ route('account.whatsapp') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="phone_number" class="col-sm-2 col-form-label">Nomor Whatsapp</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="phone_number" id="phone_number"
                                value="{{ old('phone_number', $user->phone_number ?? '628') }}" data-parsley-length="[5,255]" required>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class='table table-bordered'>
                    <tbody>
                        <tr class='active'>
                            <td colspan="2"><strong><i class='fa fa-bars'></i> Data Diri</strong></td>
                        </tr>
                        <tr>
                            <td width="25%"><strong>Foto</strong></td>
                            <td>
                                <a class="image-popup-no-margins" href="{{ asset($user->photo) }}">
                                    <img class="img-fluid" alt="{{ $user->name }}" src="{{ asset($user->photo) }}"
                                        width="24">
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>NIK</strong></td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Nama</strong></td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tempat, Tanggal Lahir</strong></td>
                            <td>{{ $user->getPsb() }}</td>
                        </tr>
                        <tr>
                            <td><strong>Jenis Kelamin</strong></td>
                            <td>{{ $user->gender }}</td>
                        </tr>
                        <tr>
                            <td><strong>Alamat</strong></td>
                            <td>{{ $user->address ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Status Perkawinan</strong></td>
                            <td>{{ $user->marital_status }}</td>
                        </tr>
                        <tr>
                            <td><strong>Pekerjaan</strong></td>
                            <td>{{ $user->profession ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection

@section('script')

<!-- Plugins js -->
<script src="{{ URL::asset('assets/libs/datatables/datatables.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.js')}}"></script>

<script src="{{ URL::asset('assets/js/pages/datatables.init.js')}}"></script>
<script src="{{ URL::asset('assets/js/pages/lightbox.init.js')}}"></script>

@endsection