    <div class="row mb-3">
        <div class="col-xs-12 col-sm-12 col-lg-12 mb-3">
			<div class="card card-primary">
				<div class="card-header">
					<h2 class="card-title">Data Karyawan</h2>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-3">
							<label>Unit Kerja</label>
						</div>
						<div class="col-sm-6">
							@php
								$current_user = Auth()->user()->units->pluck('id');
							@endphp
							@foreach (\App\Models\UnitModel::orderBy('code', 'asc')->get() as $i => $s)
								@if( $s->id == $absensi_user->id_unit)
									<p>{{ $s->nama }}</p>
								@endif
							@endforeach
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<label>Nama Karyawan</label>
						</div>
						<div class="col-sm-6">
						<p>{{ $absensi_user->nama }}</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<label>Jabatan</label>
						</div>
						<div class="col-sm-6">
						<p>{{ $absensi_user->nama }}</p>
						</div>
					</div>
		
					<div class="row">
						<div class="col-sm-3">
							<label>Jenis Kelamin</label>
						</div>
						<div class="col-sm-6">
						<p>{{$absensi_user->jenis_kelamin}}</p>
						</div>
					</div>
		
					<div class="row">
						<div class="col-sm-3">
							<label>Photo</label>
						</div>
						<div class="col-sm-6">
							@if(!empty($absensi_user->photo))
								<br/><img src="{{ asset(Storage::url($absensi_user->photo)) }}" style="height: 150px;"/>
							@endif
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>