@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="m-0 text-dark">Hak Akses Pengguna</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title fw-bold fs-4">Hak Akses Pengguna</h2>
            <div class="card-tools">
                @can('admin.roles.create')
                    <a class="btn btn-sm btn-primary" href="{{ route('admin.roles.create') }}">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah
                    </a>
                @endcan
            </div>
        </div>
        <div class="card-body">

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th width="30">No</th>
                        <th>Name</th>
                        <th width="280">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = ($roles->currentPage() - 1) * $roles->perPage() + 1;
                    @endphp
                    @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST">
                                    <a class="btn btn-sm btn-info" href="{{ route('admin.roles.show', $role->id) }}"
                                        data-toggle="tooltip" data-placement="bottom" data-html="false"
                                        data-title="Tampilkan Detail">
                                        <i class="fas fa-search"></i>
                                    </a>
                                    @can('admin.roles.edit')
                                        <a class="btn btn-sm btn-primary" href="{{ route('admin.roles.edit', $role->id) }}"
                                            data-toggle="tooltip" data-placement="bottom" data-html="false"
                                            data-title="Edit Data">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endcan


                                    @csrf
                                    @method('DELETE')
                                    @can('admin.roles.destroy')
                                        <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip"
                                            data-placement="bottom" data-html="false" data-title="Hapus Data">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    @endcan
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {!! $roles->render() !!}
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip({})
        })
    </script>
@endpush
