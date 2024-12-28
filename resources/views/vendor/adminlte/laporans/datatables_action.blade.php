@php
	$data = App\Models\LaporanModel::find($id);
@endphp
<form action="{{ route('admin.laporan.destroy', $id) }}" method="post">
	@csrf
	@method('delete')
    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
		@if($data->status == 'diajukan')
        <a href="{{ route('admin.laporan.formMessage', $id) }}" role="button" class="btn btn-warning btn-sm" data-tooltip="tooltip" data-toggle="modal" data-target="#modalLgId" data-modal-size="modal-xl" data-backdrop="static" data-keyboard="false" data-modal-title="Pesan/Komentar" data-title="Pesan/Komentar" title="Pesan/Komentar">
            <i class="fa fa-comments" aria-hidden="true"></i>
        </a>
		@endif
		@if($data->status == 'draft')
        <button type="submit" role="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" data-tooltip="tooltip" data-modal-title="Hapus Data" data-title="Hapus Data" title="Hapus Data">
            <i class="fas fa-trash"></i>
        </button>
		@endif
    </div>
    <div class="btn-group mt-1" role="group" aria-label="Basic checkbox toggle button group">
        <a href="{{ route('admin.laporan.show', $id) }}" role="button" class="btn btn-primary btn-sm" data-tooltip="tooltip" data-toggle="modal" data-target="#modalLgId" data-backdrop="static" data-keyboard="false" data-modal-title="Lihat Data" data-title="Lihat Data" title="Lihat Data Laporan">
            <i class="fas fa-eye" aria-hidden="true"></i>
        </a>
        <a href="{{ route('admin.tindakan.stepDetail', $id) }}" role="button" class="btn btn-primary btn-sm" data-tooltip="tooltip" data-toggle="modal" data-target="#modalLgId" data-backdrop="static" data-keyboard="false" data-modal-title="Tracking Laporan" data-title="Lihat Tracking Laporan" title="Lihat Tracking Laporan">
            <i class="fa fa-sitemap" aria-hidden="true"></i>
        </a>
    </div>
</form>
