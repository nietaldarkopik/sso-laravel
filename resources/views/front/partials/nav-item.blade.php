@php
$submenus = \App\Models\MenuModel::where('parent_id','=',$menu->id)->orderBy('sort_order','asc')->get();
@endphp
@if($submenus->count() == 0)
	<li class="nav-item">
		<a class="nav-link fs-5 lh-1 oswald-regular" href="./">{{ $menu->title }}</a>
	</li>
@else
	<li class="nav-item dropdown">
		<a class="nav-link fs-5 lh-1 oswald-regular dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
			{{ $menu->title }}
		</a>
		<ul class="dropdown-menu">
			@foreach($submenus as $i => $menu)
				@include('front.partials.dropdown-item',['menu' => $menu])
			@endforeach
		</ul>
	</li>
@endif