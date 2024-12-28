@extends('adminlte::page')


@section('title', 'Tracking Pengajuan')

@section('content_header')
    <h1 class="m-0 text-dark">Tracking Pengajuan</h1>
@stop
@section('content')
    <div class="card col-md-6">
        <div class="card-header">
            <h2 class="card-title fw-bold fs-4">Tracking Pengajuan</h2>
            <div class="card-tools">
                @can('admin.pengajuan.index')
                    <a class="btn btn-sm btn-primary" href="{{ route('admin.pengajuan.index') }}">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                    </a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            @include('vendor.adminlte.pengajuans.form-step-detail',['pengajuans'])
        </div>
    </div>

@endsection
