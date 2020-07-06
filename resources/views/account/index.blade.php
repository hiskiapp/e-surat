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
                  <img class="img-fluid" alt="{{ $user->name }}" src="{{ asset($user->photo) }}" width="24">
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