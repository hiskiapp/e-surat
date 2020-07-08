@extends('admin.print.master')
@section('content')
<div class="row pl-5 pr-5 mt-5">
	<div class="col-12">
		<h3 class="text-center">{{ $submission->letter->name }}</h3>
		<p class="text-center h5">Nomor : 581/263/Bras/2020</p>
	</div>
</div>
<div class="row pl-5 pr-5 mt-3">
	<div class="col-12">
		<p>Yang bertanda tangan di bawah ini :</p>
		<table class="table table-borderless">
			@if(setting('vh_status') == 'On')
			<tr>
				<td width="32%">Nama</td>
				<td>:</td>
				<td>@setting('village_head')</td>
			</tr>
			<tr>
				<td>Jabatan</td>
				<td>:</td>
				<td>Kepala Desa</td>
			</tr>
			@else
			<tr>
				<td width="32%">Nama</td>
				<td>:</td>
				<td>@setting('secretary')</td>
			</tr>
			<tr>
				<td>Jabatan</td>
				<td>:</td>
				<td>Sekretaris</td>
			</tr>
			@endif
		</table>
		<p class="mt-3">Menerangkan dengan sebenarnya bahwa :</p>
		<table class="table table-borderless">
			<tr>
				<td width="32%">Nama</td>
				<td>:</td>
				<td>{{ $submission->user->name }}</td>
			</tr>
			<tr>
				<td>Tempat, Tanggal Lahir</td>
				<td>:</td>
				<td>{{ $submission->user->getPsb() }}</td>
			</tr>
			<tr>
				<td>NIK</td>
				<td>:</td>
				<td>{{ $submission->user->sin }}</td>
			</tr>
			<tr>
				<td>Status Perkawinan</td>
				<td>:</td>
				<td>{{ $submission->user->marital_status }}</td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>:</td>
				<td>{{ $submission->user->gender }}</td>
			</tr>
			<tr>
				<td>Agama</td>
				<td>:</td>
				<td>{{ $submission->user->religion }}</td>
			</tr>
			<tr>
				<td>Pekerjaan</td>
				<td>:</td>
				<td>{{ $submission->user->profession }}</td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td>{{ $submission->user->address }}</td>
			</tr>
			@foreach(json_decode($submission->data) as $title => $data)
			<tr>
				<td>{{ ucwords($title) }}</td>
				<td>:</td>
				<td>{{ $data }}</td>
			</tr>
			@endforeach
		</table>
		<p class="mt-3">Orang tersebut di atas sepanjang pengetahuan saya memang benar mempunyai usaha usaha sukla yang
			beralamat di klungkung.</p>

		<p class="mt-3">Demikian Surat Keterangan ini kami buat dengan sebenarnya untuk dapat dipergunakan bilamana perlu.
		</p>
	</div>
</div>
@endsection