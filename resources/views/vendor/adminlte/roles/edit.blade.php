@extends('adminlte::page')

@section('title', 'Hak Akses Pengguna')

@section('content_header')
    <h1 class="m-0 text-dark">Hak Akses Pengguna</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title fw-bold fs-4">Edit Hak Akses</h2>
            <div class="card-tools">
                <a class="btn btn-primary" href="{{ route('admin.roles.index') }}">
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

            <form action="{{ route('admin.roles.update', $role->id) }}" method="post">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col-sm-12 mb-3">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" value="{{ $role->name }}" name="name" class="form-control"
                                placeholder="Name">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <strong>Permission:</strong>
                        </div>
                    </div>
                    @foreach ($permission as $value)
                        <div class="col-sm-4 col-md-3">
                            <label>
                                <input type="checkbox" @if (in_array($value->id, $rolePermissions)) checked @endif name="permission[]"
                                    value="{{ $value->name }}" class="name">
                                {{ $value->name }}</label>
                        </div>
                    @endforeach
                </div>
                <div class="col-sm-12 mb-3 text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save" aria-hidden="true"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
