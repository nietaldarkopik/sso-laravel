<div class="card">
	<div class="card-body">
		<div class="row d-flex justify-content-center align-items-center">
			<div class="col-md-12 text-center">
				@if(isset($data->user->photo) and !empty($data->user->photo))
				<img src="{{ asset(Storage::url($data->user->photo))}}" class="img w-75">
				@else
				<img src="{{ asset('front/img/clients/client-1.png') }}" class="img w-75">
				@endif
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<h2 class="lato-bold text-dark fs-5 text-center mt-3 fw-bolder lh-1 text-uppercase">{{ $data->user->nama ?? ''}}</h2>
				<h3 class="lato-bold text-dark fs-5 text-center fw-bolder lh-1 text-uppercase">{{ $data->user->jabatan ?? ''}}</h3>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<h2 class="text-center lato-bold text-dark fs-6 fw-bolder lh-1">{{ $data->device->device_no ?? ''}} - {{ $data->device->device_name ?? ''}}</h2>
				<p class="text-center lato-bold text-dark fs-6 fw-bolder lh-1"><strong>{{ $data->device->location ?? ''}}</strong></p>
			</div>
		</div>
		
		{{-- <div class="row">
			<div class="col-md-12">
				<h2 class="text-center lato-bold text-dark fs-6 fw-bolder lh-1">Datang : {{ $data->datang}}</h2>
				<h2 class="text-center lato-bold text-dark fs-6 fw-bolder lh-1">Pulang : @if($data->pulang == $data->datang || empty($data->pulang)) - @else {{ $data->pulang}} @endif</h2>
			</div>
		</div> --}}
		<button type="button" class="btn btn-play-sound d-none">Play</button>
	</div>
</div>
<script>
	$(document).ready(function(){
		$(".btn-play-sound").on("click",function(){
			playSound({{$data->id}});
		});

		$(".btn-play-sound").trigger("click");
	});
</script>