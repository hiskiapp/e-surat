@extends('admin.layouts.master')

@section('title', 'Helpers')

@section('content')

<!-- start page title -->
<div class="row align-items-center">
    <div class="col-sm-6">
        @component('admin.components.breadcumb')
        @slot('title') Helpers @endslot
        @slot('li_1') Admin @endslot
        @endcomponent
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Helpers</h4>
                <table class='table table-bordered'>
                    <tbody>
                        <tr class='active'>
                            <td colspan="2"><strong><i class='fa fa-bars'></i> Kumpulan Helper Untuk Surat. Untuk tutorial lengkap silakan klik <a href ="https://aguswahyu.com/panduan-esurat-admin/" target="_blank">DISINI</strong></td>
                        </tr>
                        <tr>
                            <td width="25%"><strong>Nama Penandatangan</strong></td>
                            <td>[signatory_name]</td>
                        </tr>
                        <tr>
                            <td><strong>Jabatan Penandatangan</strong></td>
                            <td>[signatory_position]</td>
                        </tr>
                        <tr>
                            <td><strong>Atas Nama Perbengkel</strong> (Jika Perbengkel Tidak Hadir Akan Muncul)</td>
                            <td>[on_behalf]</td>
                        </tr>
                        <tr>
                            <td><strong>Nama</strong></td>
                            <td>[name]</td>
                        </tr>
                        <tr>
                            <td><strong>Tempat, Tanggal Lahir</strong></td>
                            <td>[ttl]</td>
                        </tr>
                        <tr>
                            <td><strong>Nomor KTP</strong></td>
                            <td>[sin]</td>
                        </tr>
                        <tr>
                            <td><strong>Status Perkawinan</strong></td>
                            <td>[marital_status]</td>
                        </tr>
                        <tr>
                            <td><strong>Jenis Kelamin</strong></td>
                            <td>[gender]</td>
                        </tr>
                        <tr>
                            <td><strong>Agama</strong></td>
                            <td>[religion]</td>
                        </tr>
                        <tr>
                            <td><strong>Pekerjaan</strong></td>
                            <td>[profession]</td>
                        </tr>
                        <tr>
                            <td><strong>Alamat</strong></td>
                            <td>[address]</td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal</strong></td>
                            <td>[tgl]</td>
                        </tr>
                        <tr>
                            <td><strong>Nama Desa</strong></td>
                            <td>[village]</td>
                        </tr>
                        <tr>
                            <td><strong>Nama Kecamatan</strong></td>
                            <td>[sub-districts]</td>
                        </tr>
                        <tr>
                            <td><strong>Nama Kabupaten</strong></td>
                            <td>[districts]</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection