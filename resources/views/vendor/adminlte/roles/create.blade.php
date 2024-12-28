@extends('adminlte::page')

@section('title', 'Hak Akses Pengguna')

@section('content_header')
    <h1 class="m-0 text-dark">Hak Akses Pengguna</h1>
@stop
@section('content')
    <div class="card col-md-12 mx-auto">
        <div class="card-header">
            <h2 class="card-title fw-bold fs-4">Tambah Hak Akses</h2>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary" href="{{ route('admin.roles.index') }}">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.roles.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="name" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Permission:</strong>
                        </div>
                    </div>
                    @foreach ($permission as $value)
                        <div class="col-xs-12 col-sm-4 col-md-3">
                            <label>
                                <input type="checkbox" name="permission[]" value="{{ $value->name }}" class="name">
                                {{ $value->name }}</label>
                        </div>
                    @endforeach
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save" aria-hidden="true"></i> Simpan
                    </button>
                </div>
        </div>
        </form>
    </div>
    </div>
@endsection
