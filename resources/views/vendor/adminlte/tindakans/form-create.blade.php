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

<form action="{{ route('admin.pengajuan.store') }}" class="form-create-pengajuan" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row mb-3">
        <div class="col-xs-12 col-sm-12 col-lg-8 mb-3">
			<div class="card card-primary">
				<div class="card-header">
					<h2 class="card-title">Data Pengajuan</h2>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group p-2 mb-1">
								<label>Jenis Pengajuan</label>
								<select required="required" name="id_sop" id="input-id_sop"
									class="form-select form-custom border py-0 text-italic-0 form-control-sm w-100 custom-select2">
									<option value="">Pilih Jenis Pengajuan ...</option>
									@foreach (\App\Models\SopModel::orderBy('sop', 'asc')->get() as $i => $s)
										<option value="{{ $s->id }}">{{ $s->kode }} - {{ $s->sop }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group p-2 mb-1">
								<label>Dari Unit</label>
								@php
									$current_user = Auth()->user()->units->pluck('id');
								@endphp
								<select required="required" name="id_unit" id="input-id_unit"
									class="form-select form-custom border py-0 text-italic-0 form-control-sm w-100 custom-select2">
									<option value="">Pilih Unit ...</option>
									@foreach (\App\Models\UnitModel::whereIn('id',$current_user)->orderBy('code', 'asc')->get() as $i => $s)
										<option value="{{ $s->id }}">{{ $s->code }} - {{ $s->nama }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 p-0 px-1">
							<div class="form-group p-2 mb-1">
								<label>Judul Pengajuan</label>
								<input required="required" type="text" name="judul" value=""
								class="form-control border py-0 text-italic-0 form-control-sm"
								placeholder="Judul Pengajuan" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 p-0 px-1">
							<div class="form-group p-2 mb-1">
								<label>Jumlah Anggaran</label>
								<input required="required" type="number" name="nominal" value=""
								class="form-control border py-0 text-italic-0 form-control-sm"
								placeholder="Masukan anggaran yang dibutuhkan, jika tidak ada ketik 0" />
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group p-2 mb-1">
								<label>Tanggal</label>
								<input type="text" name="tgl_pengajuan" value=""
								class="form-control border py-0 text-italic-0 form-control-sm custom-datepicker" placeholder="Tanggal" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group p-2 mb-1">
								<label>Keterangan</label>
								<textarea type="text" name="keterangan" rows="5"
									class="form-control border py-0 text-italic-0 form-control-sm" placeholder="Keterangan"></textarea>
							</div>
						</div>
					</div>
		
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group p-2 mb-1">
								<label>Status Data</label>
								<select required="required" name="status"
									class="form-select-form-select-custom border py-0 w-100 text-italic-0 form-control-sm">
									<option value="">Pilih Status ...</option>
									@foreach(App\Models\StatusPengajuanModel::where('grup_form',1)->get() as $i => $s)
									<option value="{{$s->kode}}" style="border-color: {{$s->warna_bg}} !important; background-color: {{$s->warna_bg}} !important; color: {{$s->warna_text}} !important;">{{$s->judul}}</option>
									@endforeach
									{{-- <option value="Draft">Draft</option>
									<option value="Diajukan">Diajukan</option>
									<option value="Batal">Batal</option> --}}
									{{-- <option value="Disetujui">Disetujui</option>
									<option value="Tidak Disetujui">Tidak Disetujui</option> --}}
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card card-primary h-auto">
				<div class="card-header">
					<h2 class="card-title">Upload Dokumen</h2>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12 dokumen-container p-2">
							<div class="form-group">
								<label for="dropzone-document">Upload Dokumen Pengajuan</label>
								<div class="needsclick dropzone dropzone-document"
									id="dropzone-document">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-12 col-lg-12 mb-1 text-center">
				<button class="btn btn-primary btn-save-pengajuan">
					<i class="fa fa-save" aria-hidden="true"></i> Simpan
				</button>
			</div>
        </div>

        <div class="col-xs-12 col-sm-12 col-lg-4 mb-3">
			<div class="card card-primary">
				<div class="card-header">
					<h2 class="card-title">Template / Contoh File</h2>
				</div>
				<div class="card-body">

					<div class="row">
						<div class="col-md-12 template-container p-2">
							<div class="alert alert-lg alert-info">Silahkan Pilih Jenis Pengajuan terlebih dahulu</div>
							<ol class="list-group list-group-ordered template-list-container">
							</ol>
						</div>
					</div>
				</div>
			</div>
			<div class="card card-primary">
				<div class="card-header">
					<h2 class="card-title">Prosedur</h2>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12 prosedur-container p-2">
							<div class="alert alert-lg alert-info">Silahkan Pilih Jenis Pengajuan terlebih dahulu</div>

							<ol class="list-group list-group-ordered step-container">
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>

</form>
