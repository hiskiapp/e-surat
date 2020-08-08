@extends('admin.layouts.master')

@section('title', 'Pengajuan Surat: Disetujui')

@section('css')
<link href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<!-- start page title -->
<div class="row align-items-center">
    <div class="col-sm-6">
        @component('admin.components.breadcumb')
        @slot('title') Pengajuan Surat: Disetujui @endslot
        @slot('li_1') Admin @endslot
        @endcomponent
    </div>
    <div class="col-sm-6">
        <div class="float-right d-md-block mb-3">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle waves-effect waves-light" type="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="mdi mdi-gesture-spread mr-2"></i> Action
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <form method="POST" action="{{ route('admin.submissions.approved.export') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">Export</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Pengajuan Surat: Disetujui</h4>
                @include('admin.components.message')
                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>Waktu Pengajuan</th>
                        <th>Nomor Surat</th>
                        <th>Nama</th>
                        <th>Jenis Surat</th>
                        <th>Waktu Penyetujuan</th>
                        <th>Disetujui Oleh</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($submissions as $submission)
                    <tr>
                        <td>{{ $submission->created_at->formatLocalized('%d %B %Y %H:%M') }}</td>
                        <td>{{ $submission->number ?? '-' }}</td>
                        <td>{{ $submission->user->name }}</td>
                        <td>{{ $submission->letter->name }}</td>
                        <td>{{ $submission->approval_at->formatLocalized('%d %B %Y %H:%M') }}</td>
                        <td>{{ $submission->admin->name }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.submissions.print', [$submission->id]) }}"
                                class="d-inline" target="_blank">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning waves-effect waves-light"><i
                                    class="mdi mdi-printer-check"></i> Cetak</button>
                                </form>
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
<script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

<script src="{{ URL::asset('assets/js/pages/datatables.init.js')}}"></script>
<script src="{{ URL::asset('assets/js/pages/lightbox.init.js')}}"></script>

<script type="text/javascript">
    $(document).on('submit', '.form-delete', function (e) {
        var form = this;
        e.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Yes, delete it!"
        }).then(function (result) {
            if (result.value) {
                return form.submit();
            }
        });
    });

</script>

@endsection