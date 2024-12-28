<nav class="main-header navbar
    {{ config('adminlte.classes_topnav_nav', 'navbar-expand-md') }}
    {{ config('adminlte.classes_topnav', 'navbar-white navbar-light') }}">

    <div class="{{ config('adminlte.classes_topnav_container', 'container') }}">

        {{-- Navbar brand logo --}}
        @if(config('adminlte.logo_img_xl'))
            @include('adminlte::partials.common.brand-logo-xl')
        @else
            @include('adminlte::partials.common.brand-logo-xs')
        @endif

        {{-- Navbar collapsible menu --}}
        <div class="collapse navbar-collapse order-3 justify-content-end" id="navbarCollapse">
            {{-- Navbar left links --}}
            <ul class="nav navbar-nav">
                {{-- Configured left links --}}
				{{-- @dd($adminlte->menu('navbar-left'),App\Models\MenuModel::select(DB::raw('*,url as href,title as text'))->where('parent_id',0)->orderBy('sort_order')->with('submenu')->get()->toArray()); --}}
                {{-- @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-left'), 'item') --}}
				@php
				$roles = Auth()->user()->roles->collect()->pluck('name')->toArray();
				$menu_group = DB::table('menu_groups')->whereIn('role',$roles)->get();
				$menu_group_ids = $menu_group?->collect()->pluck('id');
				@endphp
				
                @each('adminlte::partials.navbar.menu-item', App\Models\MenuModel::select(DB::raw('*,"" as class, concat("'.url('/').'",url) as href,title as text'))->with('submenu')->where(function($query) use ($menu_group_ids){
					$query->where('parent_id','=',0);
					$query->whereIn('menu_group_id',$menu_group_ids);
				})->orderBy('sort_order')->get()->toArray(), 'item')

                {{-- Custom left links --}}
                @yield('content_top_nav_left')
            </ul>
        </div>

        {{-- Navbar right links --}}
        <ul class="navbar-nav ml-auto order-1 order-md-3 navbar-no-expand">
            {{-- Custom right links --}}
            @yield('content_top_nav_right')

            {{-- Configured right links --}}
            @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-right'), 'item')

            {{-- User menu link --}}
            @if(Auth::user())
                @if(config('adminlte.usermenu_enabled'))
                    @include('adminlte::partials.navbar.menu-item-dropdown-user-menu')
                @else
                    @include('adminlte::partials.navbar.menu-item-logout-link')
                @endif
            @endif

            {{-- Right sidebar toggler link --}}
            @if(config('adminlte.right_sidebar'))
                @include('adminlte::partials.navbar.menu-item-right-sidebar-toggler')
            @endif
        </ul>

        {{-- Navbar toggler button --}}
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    </div>

</nav>
