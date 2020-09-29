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
              <td>{{ $submission->created_at->formatLocalized('%d %B %Y %H:%M') }}</td>
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
                        <tr class='active'>
              <td colspan="2"><strong>(Masukan Nomor Surat Dahulu Kemudian Save)</strong></td>
            </tr>
          </tbody>
        </table>
        <form class="custom-validation" method="POST" action="{{ route('admin.submissions.update', $submission->id) }}"
          enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <div class="form-group row">
            <label for="number" class="col-sm-2 col-form-label">Nomor Surat</label>
            <div class="col-sm-10">
              <input class="form-control" type="text" name="number" id="number" value="{{ $submission->number ?? '-' }}"
                required>
            </div>
          </div>
          @foreach($submission->letter->getData() as $key => $data)
          <div class="form-group row">
            <label for="{{ $data->input_name }}" class="col-sm-2 col-form-label">{{ $data->input_label }}</label>
            <div class="col-sm-10">
              @switch($data->input_type)
              @case('number')
              <input class="form-control" type="number" name="{{ $data->input_name }}" id="{{ $data->input_name }}"
                value="{{ $submission->getData($data->input_name) }}" required>
              @break
              @case('textarea')
              <textarea name="{{ $data->input_name }}" class="form-control" rows="3"
                required>{{ $submission->getData($data->input_name) }}</textarea>
              @break
              @case('editor')
              <textarea id="elm1" name="{{ $data->input_name }}"
                required>{{ $submission->getData($data->input_name) }}</textarea>
              @break
              @default
              <input class="form-control" type="text" name="{{ $data->input_name }}" id="{{ $data->input_name }}"
                value="{{ $submission->getData($data->input_name) }}" required>
              @endswitch
            </div>
          </div>
          @endforeach
          <div class="form-group mb-0">
            <div>
              <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                <i class="mdi mdi-pencil"></i>
                Save
              </button>
              <button type="submit" form="form-print" class="btn btn-warning waves-effect waves-light mr-1"><i
                  class="mdi mdi-printer-check"></i>
                Cetak</button>
              @foreach($signatories as $signatory)
              <button type="submit" form="form-print-{{ $signatory->id }}"
                class="btn btn-danger waves-effect waves-light mr-1"><i class="mdi mdi-printer-check"></i>
                Cetak Sebagai {{ $signatory->position }}</button>
              @endforeach
            </div>
          </div>
        </form>
        <form id="form-print" method="POST" action="{{ route('admin.submissions.print', [$submission->id]) }}"
          class="d-inline form-print" target="_blank">
          @csrf
        </form>
        @foreach($signatories as $signatory)
        <form id="form-print-{{ $signatory->id }}" method="POST"
          action="{{ route('admin.submissions.print', [$submission->id, 'signatory' => $signatory->id]) }}"
          class="d-inline form-print" target="_blank">
          @csrf
        </form>
        @endforeach
      </div>
    </div>
  </div> <!-- end col -->
</div>

@endsection

@section('script')

<!-- Plugins js -->
<script src="{{ URL::asset('assets/libs/datatables/datatables.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/tinymce/tinymce.min.js')}}"></script>

<script src="{{ URL::asset('assets/js/pages/datatables.init.js')}}"></script>
<script src="{{ URL::asset('assets/js/pages/lightbox.init.js')}}"></script>
<script src="{{ URL::asset('assets/js/pages/form-editor.init.js')}}"></script>

@endsection