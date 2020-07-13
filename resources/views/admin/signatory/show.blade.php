@extends('admin.layouts.master')

@section('title', 'Detail Penandatangan: ' . $signatory->name)

@section('content')

<!-- start page title -->
<div class="row align-items-center">
    <div class="col-sm-6">
        @component('admin.components.breadcumb')
        @slot('title') Detail Penandatangan: {{ $signatory->name }} @endslot
        @slot('li_1') Penandatangan @endslot
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
                            <td colspan="2"><strong><i class='fa fa-bars'></i> Detail Penandatangan</strong></td>
                        </tr>
                        <tr>
                            <td><strong>Nama</strong></td>
                            <td>{{ $signatory->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Jabatan</strong></td>
                            <td>{{ $signatory->position }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection