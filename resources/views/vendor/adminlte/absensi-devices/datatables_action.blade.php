@php
	$absensi_device = App\Models\AbsensiDeviceModel::find($id);
@endphp
<form action="{{ route('admin.absensi_device.destroy', $absensi_device) }}" method="post">
	@csrf
	@method('delete')
    <div class="btn-group mt-1" role="group" aria-label="Basic checkbox toggle button group">
		{{-- @can('admin.absensi_device.show')
        <a href="{{ route('admin.absensi_device.show', $id) }}" role="button" class="btn btn-primary btn-sm" data-tooltip="tooltip" data-toggle="modal" data-target="#modalLgId" data-backdrop="static" data-keyboard="false" data-modal-title="Lihat Data" data-title="Lihat Data" title="Lihat Data Device">
            <i class="fas fa-eye" aria-hidden="true"></i>
        </a>
		@endcan --}}
		@can('admin.absensi_device.edit')
        <a href="{{ route('admin.absensi_device.edit', $id) }}" role="button" class="btn btn-primary btn-sm" data-tooltip="tooltip" data-toggle="modal" data-target="#modalLgId" data-backdrop="static" data-keyboard="false" data-modal-title="Tracking Device" data-title="Lihat Tracking Device" title="Lihat Tracking Device">
            <i class="fa fa-edit" aria-hidden="true"></i>
        </a>
		@endcan
		@can('admin.absensi_device.destroy')
        <button type="submit" role="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" data-tooltip="tooltip" data-modal-title="Hapus Data" data-title="Hapus Data" title="Hapus Data">
            <i class="fas fa-trash"></i>
        </button>
		@endcan
    </div>
</form>
