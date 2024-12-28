@extends('adminlte::page')

@section('title', 'Data Pengguna')

@section('content_header')
    <h1 class="m-0 text-dark">Data Pengguna</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title fw-bold fs-4">Data Pengguna</h2>
            <div class="card-tools">
                @can('admin.users.create')
                    <a class="btn btn-sm btn-primary" href="{{ route('admin.users.create') }}">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah
                    </a>
                @endcan
            </div>
        </div>
        <div class="card-body">

            @if ($message = Session::get('success'))
                <div class="alert alert-success my-2">
                    <p>{{ $message }}</p>
                </div>
            @endif


            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th width="30">No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Unit</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = ($data->currentPage() - 1) * $data->perPage() + 1;
                        @endphp
                        @foreach ($data as $key => $user)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if (!empty($user->getRoleNames()))
                                        @foreach ($user->getRoleNames() as $v)
                                            <label class="badge badge-secondary text-light fs-6">{{ $v }}</label>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($user->units()->get()->pluck('nama')))
                                        @foreach ($user->units()->get()->pluck('nama') as $v)
                                            <label class="badge badge-secondary text-light fs-6">{{ $v }}</label>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
									<form method="post" action="{{ route('admin.users.destroy', $user->id)}}">
										@csrf
										@method('delete')
                                    <a class="btn btn-sm btn-info" href="{{ route('admin.users.show', $user->id) }}"
                                        data-toggle="tooltip" data-placement="bottom" data-html="false"
                                        data-title="Tampilkan Detail">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn btn-sm btn-primary" href="{{ route('admin.users.edit', $user->id) }}"
                                        data-toggle="tooltip" data-placement="bottom" data-html="false"
                                        data-title="Edit Data">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>
										<button class="btn btn-sm btn-danger" href="{{ route('admin.users.destroy', $user->id) }}"
											data-toggle="tooltip" data-placement="bottom" data-html="false"
											data-title="Hapus Data">
											<i class="fa fa-trash" aria-hidden="true"></i>
										</button>
									</form>
                                </td>	
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {!! $data->render() !!}
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
