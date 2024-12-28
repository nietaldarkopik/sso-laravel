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

<div class="row mb-3">
	<div class="col-xs-12 col-sm-12 col-lg-12 mb-3">
		<div class="card card-primary">
			<div class="card-header">
				<h2 class="card-title">Data Pengajuan</h2>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group p-2 mb-1">
							<label class="mb-0">Jenis Pengajuan : </label>
							<span class="text-muted form-text">
								@php
								$sop = \App\Models\SopModel::where('id',$pengajuan?->id_sop)->orderBy('sop', 'asc')->get()->first();
								@endphp
								{{ $sop->kode }} - {{ $sop->sop }}
							</span>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group p-2 mb-1">
							<label class="mb-0">Dari Unit : </label>
							<span class="text-muted form-text">
								@php
									$unit = \App\Models\UnitModel::where('id',$pengajuan?->id_unit)->orderBy('code', 'asc')->get()->first();
								@endphp
								{{ $unit->code }} - {{ $unit->nama }}
							</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 p-0 px-1">
						<div class="form-group p-2 mb-1">
							<label class="mb-0">Judul Pengajuan : </label>
							<span class="text-muted form-text">{{ $pengajuan?->judul }}</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 p-0 px-1">
						<div class="form-group p-2 mb-1">
							<label class="mb-0">Jumlah Anggaran : </label>
							<span class="text-muted form-text">{{ $pengajuan?->nominal }}</span>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group p-2 mb-1">
							<label class="mb-0">Tanggal : </label>
							<span class="text-muted form-text">{{ $pengajuan?->tgl_pengajuan}}</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group p-2 mb-1">
							<label class="mb-0">Keterangan : </label>
							<span class="text-muted form-text">{{$pengajuan?->keterangan}}</span>
						</div>
					</div>
				</div>
	
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group p-2 mb-1">
							<label class="mb-0">Status Data : </label>
							@php
								$status = App\Models\StatusPengajuanModel::where(function($query) use ($pengajuan){
									$query->where('kode', $pengajuan?->status);
									$query->where('grup_form', 1);
								})->get()->first();
								@endphp
								<span class="text-muted badge p-2"
								style="border-color: {{$status?->warna_bg}} !important; background-color: {{$status?->warna_bg}} !important; color: {{$status?->warna_text}} !important;">
									{{$status?->judul}}
								</span>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card card-primary h-auto">
			<div class="card-header">
				<h2 class="card-title">Dokumen</h2>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12 p-2">
						<!-- Some borders are removed -->
						<ul class="list-group">
							@foreach($pengajuan->documents()->get() as $i => $d)
							<li class="list-group-item">
								<div class="row">
									<div class="col-9">
										{{ basename($d->file) }}
									</div>
									<div class="col-3 text-right">
										<a href="{{ asset(Storage::url($d->file)) }}" target="_blank" class="btn btn-sm btn-primary" title="Lihat File">
											<i class="fa fa-eye" aria-hidden="true"></i>
										</a>
									</div>
								</div>
							</li>
							@endforeach
						</ul>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
