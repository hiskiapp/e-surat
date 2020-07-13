@extends('admin.layouts.master')

@section('title', 'Edit Surat: ' . $letter->name)

@section('content')

<!-- start page title -->
<div class="row align-items-center">
    <div class="col-sm-6">
        @component('admin.components.breadcumb')
        @slot('title') Edit Surat @endslot
        @slot('li_1') Surat @endslot
        @endcomponent
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Tambah Surat</h4>
                <p class="card-title-desc">Silahkan isi dengan benar form dibawah.</p>

                @include('admin.components.message')

                <form class="custom-validation" method="POST" action="{{ route('admin.letters.update', $letter->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama Surat *</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="name" id="name"
                                value="{{ old('name') ?? $letter->name }}" data-parsley-length="[5,255]" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="content" class="col-sm-2 col-form-label">Template *</label>
                        <div class="col-sm-10">
                            <textarea id="elm1" name="content"
                                required>{{ old('content') ?? $letter->content }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="data" class="col-sm-2 col-form-label">Data *</label>
                        <div class="col-sm-10 repeater">
                            <div data-repeater-list="data">
                                @foreach(json_decode($letter->data) as $data)
                                <div data-repeater-item class="row">
                                    <div class="form-group col-lg-3">
                                        <label for="label">Input Label</label>
                                        <input type="text" id="label" name="input_label"
                                            value="{{ $data->input_label }}" class="form-control"
                                            data-parsley-length="[5,255]" required />
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="input_name">Input Name</label>
                                        <input type="text" id="input_name" name="input_name"
                                            value="{{ $data->input_name }}" class="form-control"
                                            data-parsley-length="[5,255]" required />
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="input_type">Input Type</label>
                                        <select id="input_type" class="form-control" name="input_type" required>
                                            <option selected disabled>* Pilih</option>
                                            <option value="text" {{ $data->input_type == 'text' ? 'selected' : ''}}>
                                                String</option>
                                            <option value="number" {{ $data->input_type == 'number' ? 'selected' : ''}}>
                                                Number</option>
                                            <option value="textarea"
                                                {{ $data->input_type == 'textarea' ? 'selected' : ''}}>Text Area
                                            </option>
                                            <option value="editor" {{ $data->input_type == 'editor' ? 'selected' : ''}}>
                                                Editor</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-2 align-self-center">
                                        <input data-repeater-delete type="button" class="btn btn-primary btn-block"
                                            value="Delete" />
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <input data-repeater-create type="button" class="btn btn-success mo-mt-2" value="Add" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Status *</label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="status" id="switch3" switch="bool"
                                {{ $letter->status == 'On' ? 'checked' : '' }} />
                            <label for="switch3" data-on-label="On" data-off-label="Off"></label>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                Submit
                            </button>
                            <a class="btn btn-secondary waves-effect waves-light"
                                href="{{ route('admin.letters.index') }}" role="button">Cancel</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection

@section('script')
<!-- Plugins js -->
<script src="{{ URL::asset('assets/libs/parsleyjs/parsleyjs.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/tinymce/tinymce.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/jquery-repeater/jquery-repeater.min.js')}}"></script>

<script src="{{ URL::asset('assets/js/pages/form-repeater.int.js')}}"></script>
<script src="{{ URL::asset('assets/js/pages/form-editor.init.js')}}"></script>
<script src="{{ URL::asset('assets/js/pages/form-validation.init.js')}}"></script>
@endsection