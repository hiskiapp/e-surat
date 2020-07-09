@extends('admin.layouts.master')

@section('title', 'Log Activity')

@section('css')
<link href="{{ URL::asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<!-- start page title -->
<div class="row align-items-center">
    <div class="col-sm-6">
        @component('components.breadcumb')
        @slot('title') Log Activity @endslot
        @slot('li_1') Home @endslot
        @endcomponent
    </div>
</div>
<!-- end page title -->

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
<script src="{{ URL::asset('assets/libs/datatables/datatables.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.js') }}"></script>

<script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/lightbox.init.js') }}"></script>

@endsection