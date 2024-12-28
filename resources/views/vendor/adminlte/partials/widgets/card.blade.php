{{-- 
	$title = '';
	$content = ''; 
	parent_id
	child_id
--}}

@if(isset($data) and count($data) > 0)
@foreach($data as $i => $d)
<div id="accordionContainer{{$d->id}}" role="tablist" aria-multiselectable="true" class="card-sortable">
	<div class="card">
		<div class="card-header" role="tab" id="sectionHeader{{$d->id}}">
			<h5 class="mb-0">
				<a data-toggle="collapse" data-parent="#accordionContainer{{$d->id}}" href="#sectionContent{{ $d->id }}" aria-expanded="true" aria-controls="sectionContent{{ $d->id }}">
					{{ $d->$title }} {{ $d->code }} {{ $d->parent_code}}

					<i class="fa fa-window-maximize" aria-hidden="true"></i>
				</a>
			</h5>
		</div>
		@php
		$query = $d->newQuery()->where(function($query) use($parent_id,$child_id,$d){
						$query->where($parent_id,$d->$child_id);
					})->get();
		$subdata = ['data' => $query, 'title' => $title, 'parent_id' => $parent_id, 'child_id' => $child_id];
		@endphp
		<div id="sectionContent{{ $d->id }}" class="collapse in" role="tabpanel" aria-labelledby="sectionHeader{{$d->id}}">
			<div class="card-body">
			@if($query->count() > 0)
				@include('vendor.adminlte.partials.widgets.card',$subdata)
			@endif
		</div>
		</div>
	</div>
</div>
@endforeach
@endif