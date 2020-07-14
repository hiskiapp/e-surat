@extends('admin.layouts.master')

@section('title', 'Home')

@section('content')
<!-- start page title -->
<div class="row align-items-center">
    <div class="col-sm-6">
        <div class="page-title-box">
            <h4 class="font-size-18">Dashboard</h4>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item active">Selamat Datang di Dashboard {{ config('app.name') }},
                    {{ auth('admin')->user()->name }}!</li>
            </ol>
        </div>
    </div>
</div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat bg-primary text-white">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-left mini-stat-img mr-4">
                        <img src="{{ asset('assets/images/services-icon/01.png') }}" alt="">
                    </div>
                    <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Pengajuan</h5>
                    <h4 class="font-weight-medium font-size-24">{{ $submissions }} <i
                            class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat bg-primary text-white">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-left mini-stat-img mr-4">
                        <img src="{{ asset('assets/images/services-icon/01.png') }}" alt="">
                    </div>
                    <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Disetujui</h5>
                    <h4 class="font-weight-medium font-size-24">{{ $submissionsApproved }} <i
                            class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat bg-primary text-white">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-left mini-stat-img mr-4">
                        <img src="{{ asset('assets/images/services-icon/01.png') }}" alt="">
                    </div>
                    <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Warga</h5>
                    <h4 class="font-weight-medium font-size-24">{{ $users }} <i
                            class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat bg-primary text-white">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-left mini-stat-img mr-4">
                        <img src="{{ asset('assets/images/services-icon/01.png') }}" alt="">
                    </div>
                    <h5 class="font-size-16 text-uppercase mt-0 text-white-50">Surat</h5>
                    <h4 class="font-weight-medium font-size-24">{{ $letters }} <i
                            class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection

@section('script')
<script src="{{ URL::asset('assets/js/pages/dashboard.init.js')}}"></script>
@endsection