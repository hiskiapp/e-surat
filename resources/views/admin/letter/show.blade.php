@extends('admin.layouts.master')

@section('title', 'Detail Surat: ' . $letter->name)

@section('css')
<link href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<!-- start page title -->
<div class="row align-items-center">
    <div class="col-sm-6">
        @component('admin.components.breadcumb')
        @slot('title') Detail Surat: {{ $letter->name }} @endslot
        @slot('li_1') Surat @endslot
        @endcomponent
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class='table table-bordered'>
                    <tbody>
                        <tr class='active'>
                            <td colspan="2"><strong><i class='fa fa-bars'></i> Detail Surat</strong></td>
                        </tr>
                        <tr>
                            <td><strong>Nama</strong></td>
                            <td>{{ $letter->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Status</strong></td>
                            <td>{{ $letter->status() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Daftar Pengajuan Surat Ini</h4>
                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Waktu Pengajuan</th>
                            <th>Nama</th>
                            <th>Waktu Penyetujuan</th>
                            <th>Disetujui Oleh</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($submissions as $submission)
                        <tr>
                            <td>{{ $submission->created_at->formatLocalized('%d %B %Y %H:%M') }}</td>
                            <td>{{ $submission->user->name }}</td>
                            <td>{{ $submission->approval_at->formatLocalized('%d %B %Y %H:%M') }}</td>
                            <td>{{ $submission->admin->name }}</td>
                            <td>
                                <a class="btn btn-sm btn-warning waves-effect waves-light" href="javascript: void(0);"
                                    role="button"><i class="mdi mdi-printer-check"></i> Cetak</a>
                                <a class="btn btn-sm btn-info waves-effect waves-light"
                                    href="{{ route('admin.submissions.show', $submission->id) }}" role="button"><i
                                        class="mdi mdi mdi-eye-circle"></i> Detail</a>
                            </td>
                        </tr>
                        @endforeach
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