@extends('adminlte::page')

@section('title', 'Hak Akses Pengguna')

@section('content_header')
    <h1 class="m-0 text-dark">Hak Akses Pengguna</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title fw-bold fs-4">Detail Hak Akses</h2>
            <div class="card-tools">
                <a class="btn btn-primary" href="{{ route('admin.roles.index') }}">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $role->name }}
                    </div>
                </div>
                <div class="col-xs-12 mb-3">
                    <div class="form-group">
                        <strong>Permissions:</strong>
                    </div>
                </div>
                @if (!empty($rolePermissions))
                    @foreach ($rolePermissions as $v)
                        <div class="col-xs-12 col-sm-4 col-md-3">
                            <label class="badge badge-secondary text-light fs-5 m-1">{{ $v->name }},</label>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
