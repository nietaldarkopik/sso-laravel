{{-- 
	$title = '';
	$content = ''; 
	parent_id
	child_id
--}}

<div id="accordionContainer{{$node_level}}" role="tablist" aria-multiselectable="true" class="card-sortable pr-0">
@if(isset($data) and count($data) > 0)
@foreach($data as $i => $d)
	<div class="card card-accordion-items" data-id="{{ $d->id }}" data-code="{{ $d->code }}" data-parent_code="{{ $d->parent_code }}">
		<div class="card-header pr-0" role="tab" id="sectionHeader{{$d->id}}">
			<h5 class="mb-0 d-flex justify-content-between pr-2">
				<a class="float-start collapsed" data-toggle="collapse" data-parent="#accordionContainer{{$node_level}}" href="#sectionContent{{ $d->id }}" aria-expanded="true" aria-controls="sectionContent{{ $d->id }}">
					<i class="fa fa-plus icon-expand" aria-hidden="true"></i>
					<i class="fa fa-minus icon-collapse" aria-hidden="true"></i>
					{{ $d->code }} - {{ $d->$title }}
				</a>
				<div class="card-tools float-end">
					<form method="post" action="{{ route('admin.unit.destroy',['unit' => $d])}}">
						@csrf
						@method('delete')
						<a data-tooltip="tooltip" title="Edit" href="{{ route('admin.unit.edit',['unit' => $d])}}" class="btn btn-sm btn-primary"
							data-toggle="modal" data-target="#modalLgId" data-modal-title="Edit Data"><i class="fa fas fa-edit" aria-hidden="true"></i></a>
						<a data-tooltip="tooltip" title="Pindahkan" href="javascript:void(0);" class="btn btn-sm btn-primary"><i class="fa fa-arrows-alt action-move" aria-hidden="true"></i></a>
						<button data-tooltip="tooltip" title="Hapus" type="submit" class="btn btn-sm btn-danger"><i class="fa fas fa-times" aria-hidden="true"></i></button>
					</form>
				</div>
			</h5>
		</div>
		@php
		$query = $d;
		$query = $query->newQuery()->where(function($query) use($parent_id,$child_id,$d){
						$query->where($parent_id,'=',$d->$child_id);
						$query->where($parent_id,'!=','0');
						$query->whereNotNull($parent_id);
					})->orderBy('sort_order','asc')->get();
		$subdata = ['data' => $query, 'title' => $title, 'parent_id' => $parent_id, 'child_id' => $child_id, 'node' => $node_level, 'node_level' => $node_level+1];
		@endphp
		<div id="sectionContent{{ $d->id }}" class="collapse in" role="tabpanel" aria-labelledby="sectionHeader{{$d->id}}">
			<div class="card-body pr-0">
				@include('vendor.adminlte.partials.widgets.accordion',$subdata)
			</div>
		</div>
	</div>
@endforeach
@endif
</div>