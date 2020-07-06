@extends('layouts.master')

@section('title', 'Home')

@section('content')
<!-- start page title -->
<div class="row align-items-center">
	<div class="col-sm-6">
		<div class="page-title-box">
			<h4 class="font-size-18">Dashboard</h4>
			<ol class="breadcrumb mb-0">
				<li class="breadcrumb-item active">Selamat Datang di Dashboard {{ config('app.name') }}, {{ auth()->user()->name }}!</li>
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
				<div id="accordion">
					<div class="card mb-1">
						<div class="card-header p-3" id="headingOne">
							<h6 class="m-0 font-14">
								<a href="#collapseOne" class="text-dark" data-toggle="collapse"
								aria-expanded="true"
								aria-controls="collapseOne">
								Surat Keterangan Usaha
							</a>
						</h6>
					</div>

					<div id="collapseOne" class="collapse show"
					aria-labelledby="headingOne" data-parent="#accordion">
					<div class="card-body">
						<form class="custom-validation" method="POST" action="{{ route('store', 1) }}" enctype="multipart/form-data">
							@csrf
							<div class="form-group row">
								<label for="tujuan" class="col-sm-2 col-form-label">Tujuan *</label>
								<div class="col-sm-10">
									<input class="form-control" type="text" name="tujuan" id="tujuan" value="{{ old('tujuan') }}" data-parsley-length="[5,255]" required>
								</div>
							</div>
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
		</div>
	</div>
</div>
@endsection