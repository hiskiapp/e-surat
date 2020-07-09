@extends('admin.layouts.master')

@section('title', 'Detail Admin: ' . $admin->name)

@section('css')
<link href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<!-- start page title -->
<div class="row align-items-center">
    <div class="col-sm-6">
        @component('admin.components.breadcumb')
        @slot('title') Detail Admin: {{ $admin->name }} @endslot
        @slot('li_1') Admin @endslot
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
                            <td colspan="2"><strong><i class='fa fa-bars'></i> Detail Admin</strong></td>
                        </tr>
                        <tr>
                            <td width="25%"><strong>Photo</strong></td>
                            <td>
                                <a class="image-popup-no-margins" href="{{ asset($admin->photo) }}">
                                    <img class="img-fluid" alt="{{ $admin->name }}" src="{{ asset($admin->photo) }}"
                                        width="24">
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Name</strong></td>
                            <td>{{ $admin->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Username</strong></td>
                            <td>{{ $admin->username }}</td>
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

                <h4 class="card-title">Log Activity</h4>
                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Page</th>
                            <th>Description</th>
                            <th>Method</th>
                            <th>URL</th>
                            <th>IP</th>
                            <th>Agent</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                        <tr>
                            <td>{{ $log->created_at->formatLocalized('%d %B %Y %H:%M') }}</td>
                            <td>{{ $log->page }}</td>
                            <td>{{ $log->description }}</td>
                            <td>{{ $log->method }}</td>
                            <td><a href="{{ $log->url }}" title="{{ $log->page }}">{{ $log->url }}</a></td>
                            <td>{{ $log->ip }}</td>
                            <td>{{ $log->agent }}</td>
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