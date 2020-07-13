@extends('admin.layouts.master')

@section('title', 'Daftar Penandatangan')

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
        @slot('title') Daftar Penandatangan @endslot
        @slot('li_1') Penandatangan @endslot
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
                    <a class="dropdown-item" href="{{ route('admin.signatories.create') }}">Tambah Data</a>
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

                <h4 class="card-title">Daftar Penandatangan</h4>
                @include('admin.components.message')
                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($signatories as $signatory)
                        <tr>
                            <td>{{ $signatory->name }}</td>
                            <td>{{ $signatory->position }}</td>
                            <td>
                                <a class="btn btn-sm btn-warning waves-effect waves-light"
                                    href="{{ route('admin.signatories.edit', $signatory->id) }}" role="button"><i
                                        class="mdi mdi-grease-pencil"></i></a>
                                <form method="POST" action="{{ route('admin.signatories.destroy', $signatory->id) }}"
                                    class="d-inline form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger waves-effect waves-light"><i
                                            class="mdi mdi-trash-can"></i></button>
                                </form>
                                <a class="btn btn-sm btn-info waves-effect waves-light"
                                    href="{{ route('admin.signatories.show', $signatory->id) }}" role="button"><i
                                        class="mdi mdi mdi-eye-circle"></i></a>
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