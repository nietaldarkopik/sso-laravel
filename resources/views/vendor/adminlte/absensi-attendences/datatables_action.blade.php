@php
	$data = App\Models\AbsensiUserModel::find($id);
@endphp
<form action="{{ route('admin.absensi_attendence.destroy', $id) }}" method="post">
	@csrf
	@method('delete')
    <div class="btn-group mt-1" role="group" aria-label="Basic checkbox toggle button group">
		{{-- @can('admin.absensi_attendence.show')
        <a href="{{ route('admin.absensi_attendence.show', $id) }}" role="button" class="btn btn-primary btn-sm" data-tooltip="tooltip" data-toggle="modal" data-target="#modalLgId" data-backdrop="static" data-keyboard="false" data-modal-title="Lihat Data" data-title="Lihat Data" title="Lihat Data Karyawan">
            <i class="fas fa-eye" aria-hidden="true"></i>
        </a>
		@endcan --}}
		@can('admin.absensi_attendence.edit')
        <a href="{{ route('admin.absensi_attendence.edit', $id) }}" role="button" class="btn btn-primary btn-sm" data-tooltip="tooltip" data-toggle="modal" data-target="#modalLgId" data-backdrop="static" data-keyboard="false" data-modal-title="Tracking Karyawan" data-title="Lihat Tracking Karyawan" title="Lihat Tracking Karyawan">
            <i class="fa fa-edit" aria-hidden="true"></i>
        </a>
		@endcan
		@can('admin.absensi_attendence.destroy')
        <button type="submit" role="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" data-tooltip="tooltip" data-modal-title="Hapus Data" data-title="Hapus Data" title="Hapus Data">
            <i class="fas fa-trash"></i>
        </button>
		@endcan
    </div>
</form>
