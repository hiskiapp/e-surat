@extends('admin.layouts.master')

@section('title', 'Detail Pengajuan Surat')

@section('content')

<!-- start page title -->
<div class="row align-items-center">
  <div class="col-sm-6">
    @component('admin.components.breadcumb')
    @slot('title') Detail Pengajuan Surat @endslot
    @slot('li_1') Warga @endslot
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
              <td colspan="2"><strong><i class='fa fa-bars'></i> Detail Warga yang Mengajukan Surat</strong></td>
            </tr>
            <tr>
              <td><strong>NIK</strong></td>
              <td>{{ $submission->user->sin }}</td>
            </tr>
            <tr>
              <td><strong>Nama</strong></td>
              <td>{{ $submission->user->name }}</td>
            </tr>
            <tr>
              <td><strong>Alamat</strong></td>
              <td>{{ $submission->user->address ?? '-' }}</td>
            </tr>
            <tr>
              <td><strong>Waktu Pengajuan</strong></td>
              <td>{{ $submission->created_at->format('d F Y H:i') }}</td>
            </tr>
            <tr>
              <td><strong>Status</strong></td>
              <td>{{ $submission->getStatus() }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div> <!-- end col -->
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <table class='table table-bordered'>
          <tbody>
            <tr class='active'>
              <td colspan="2"><strong><i class='fa fa-bars'></i> Detail Surat Lanjutan</strong></td>
            </tr>
            @foreach($submission->getData() as $key => $value)
            <tr>
              <td><strong>{{ ucwords($key) }}</strong></td>
              <td>{{ $value }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="form-group mb-0">
          <div>
            <button class="btn btn-warning waves-effect waves-light mr-1">
              <i class="mdi mdi-printer-check"></i> Cetak
            </button>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- end col -->
</div>

@endsection

@section('script')

<!-- Plugins js -->
<script src="{{ URL::asset('assets/libs/datatables/datatables.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.js')}}"></script>

<script src="{{ URL::asset('assets/js/pages/datatables.init.js')}}"></script>
<script src="{{ URL::asset('assets/js/pages/lightbox.init.js')}}"></script>

@endsection