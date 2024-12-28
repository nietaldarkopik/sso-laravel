@inject('navbarItemHelper', 'JeroenNoten\LaravelAdminLte\Helpers\NavbarItemHelper')

@if ($navbarItemHelper->isSubmenu($item) and isset($item['submenu']) and is_array($item['submenu']) and count($item['submenu']) > 0)

    {{-- Dropdown submenu --}}
    @include('adminlte::partials.navbar.dropdown-item-submenu')

@elseif ($navbarItemHelper->isLink($item))

    {{-- Dropdown link --}}
    @include('adminlte::partials.navbar.dropdown-item-link')

@endif
