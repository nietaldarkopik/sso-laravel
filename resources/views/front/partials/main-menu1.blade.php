		<ul class="nav nav-pills card-header-pills">
          @foreach(App\Models\MenuModel::whereNull('parent_id')->orderBy('sort_order','asc')->get() as $i => $menu)
            @include('front.partials.nav-item')
          @endforeach
		  
		  {{-- <li class="nav-item p-1">
			<a class="nav-link active p-2 text-light" href="#">Beranda</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Hari ini</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Riwayat</a>
			</li> --}}
        </ul>