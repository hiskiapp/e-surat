@extends('layouts.master')

@section('title', 'Home')

@section('content')
<!-- start page title -->
<div class="row align-items-center">
    <div class="col-sm-6">
        <div class="page-title-box">
            <h4 class="font-size-18">Dashboard</h4>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item active">Selamat Datang di Dashboard
                    {{ config('app.name') }}, {{ auth()->user()->name }}!</li>
            </ol>
        </div>
    </div>
</div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Pengajuan</h4>
                <p class="card-title-desc">Silahkan Klik Form Surat Yang Tersedia & Isi Dengan Benar</p>
                @include('components.message')
                <div id="accordion">
                    @foreach($letters as $letter)
                    <div class="card mb-1">
                        <div class="card-header p-3" id="heading{{ $letter->id }}">
                            <h6 class="m-0 font-14">
                                <a href="#collapse{{ $letter->id }}" class="text-dark" data-toggle="collapse" aria-expanded="true"
                                aria-controls="collapse{{ $letter->id }}">{{ $letter->name }}</a>
                            </h6>
                        </div>

                        <div id="collapse{{ $letter->id }}" class="collapse" aria-labelledby="heading{{ $letter->id }}" data-parent="#accordion">
                            <div class="card-body">
                                <form class="custom-validation" method="POST" action="{{ route('store', 1) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @foreach(json_decode($letter->data) as $data)
                                    <div class="form-group row">
                                        <label for="{{ $data->input_name }}" class="col-sm-2 col-form-label">{{ $data->input_label }}</label>
                                        <div class="col-sm-10">
                                            @switch($data->input_type)
                                                @case('number')
                                                    <input class="form-control" type="number" name="{{ $data->input_name }}" id="{{ $data->input_name }}" value="{{ old($data->input_name) }}" required>
                                                    @break
                                                @case('textarea')
                                                    <textarea name="{{ $data->input_name }}" class="form-control" rows="3">{{ old($data->input_name) }}</textarea>
                                                    @break
                                                @default
                                                    <input class="form-control" type="text" name="{{ $data->input_name }}" id="{{ $data->input_name }}"
                                                        value="{{ old($data->input_name) }}" required>
                                            @endswitch
    
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="form-group mb-0">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
