<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
			<div class="card">
				<ul class="list-group list-group-flush py-3">
					<li class="list-group-item text-center border-0 pb-1">
						<p class="my-0">{{ $sop->sop }}</p>
						<h3 class="text-bold">{{ $pengajuan->judul }}</h3>
						<hr/>
					</li>
					@foreach ($sop->step as $i => $sopStep)
						@php
							$check_step = \App\Models\ProgressPengajuanModel::where(function($query) use ($pengajuan,$sopStep){
								$query->where('id_pengajuan',$pengajuan->id);
								$query->where('id_sop_step',$sopStep->id);
							})->get();
						@endphp
						<li class="list-group-item text-center border-0 pb-0">
							<div class="bg-secondary mb-0  rounded-top rounded-5 p-3">{{$sopStep->keterangan}}</div>
						</li>
						@foreach($check_step as $ics => $cs)
						@php
							$curr_user = \App\Models\User::where('id',$cs->id_user)->get()->first();
							$curr_unit = \App\Models\UnitModel::where('id',$cs->id_unit)->get()->first();
							$curr_status = \App\Models\StatusPengajuanModel::where('kode',$cs->status)->get()->first();
							$status_locked = \App\Models\StatusPengajuanModel::where('grup',3)->get()->pluck('kode')->toArray();
							$is_status_locked = (in_array($curr_status?->kode,$status_locked));
						@endphp
						<li class="list-group-item border-0 text-center py-0">
							{{-- <i class="fas fa-long-arrow-alt-down size-3" style="font-size: 35px;"></i><br/> --}}
							<div class="card text-start mb-0 rounded-bottom rounded-start-0 rounded-5">
								<div class="card-header bg-secondary mb-0 rounded-bottom rounded-top-0 rounded-5" @if(isset($curr_status->warna_bg)) style="background-color: {{$curr_status->warna_bg}} !important; color: {{$curr_status->warna_text}} !important;" @endif>
									{{ $curr_status?->judul }}
								</div>
								@if(Auth()->user()->id == $cs->id_user && !$is_status_locked)
									<div class="card-header bg-secondary mb-0">
										<div class="mb-3">
											<label for="" class="form-label">Status</label><br/>
											<select class="form-select form-select-lg form-control" name="status_baru">
												<option value="">Pilih Status ...</option>
												@foreach(App\Models\StatusPengajuanModel::where('grup_form',2)->get() as $i => $s)
												<option value="{{$s->kode}}" @selected($curr_status->kode == $s->kode) style="border-color: {{$s->warna_bg}} !important; background-color: {{$s->warna_bg}} !important; color: {{$s->warna_text}} !important;">{{$s->judul}}</option>
												@endforeach
											</select>
										</div>
										
										<button class="btn btn-warning animated pulse infinite btn-update-status" data-pengajuan_id="{{ $pengajuan->id }}" data-sop_step_id="{{ $sopStep->id}}" data-unit_id="{{ $cs->id_unit }}">
											<i class="fa fa-edit" aria-hidden="true"></i> Update Status
										</button>
									</div>
								@endif
								<div class="card-body">
									@if(!empty($curr_user))
										<h4 class="text-center">
											{{ $curr_user->name }}
										</h4>
									@endif
									@if(!empty($curr_unit))
										<p class="card-text text-center">
											{{ $curr_unit->nama }}
										</p>
									@endif
								</div>
							</div>
							{{-- @if($i < $sop->step->count() -1)<i class="fas fa-long-arrow-alt-down size-3" style="font-size: 35px;"></i>@endif --}}
							<i class="fas fa-long-arrow-alt-down size-3" style="font-size: 35px;"></i>
						</li>
						@endforeach
					@endforeach
					<li class="list-group-item border-0 text-center py-0">
						<span class="btn btn-success">Selesai</span>
					</li>
				</ul>
			</div>
        </div>
    </div>
</div>