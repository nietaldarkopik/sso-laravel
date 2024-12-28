@extends('adminlte::page')

@section('title', 'Data Karyawan')

@section('content_header')
    <h1 class="m-0 text-dark">Data Karyawan</h1>
@stop

@section('content')
    <div class="card col-md-6">
        <div class="card-header">
            <h2 class="card-title fw-bold fs-4">Detail Karyawan</h2>
            <div class="card-tools">
                @can('admin.absensi_user.index')
                    <a class="btn btn-sm btn-primary" href="{{ route('admin.absensi_user.index') }}">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                    </a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            @include('vendor.adminlte.absensi-users.form-show')
        </div>
    </div>
@endsection
