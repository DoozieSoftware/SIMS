@php
// Fetch user menus dynamically
$user_menus = DB::table('user_menus as um')
->leftJoin('menus as m', 'm.id', '=', 'um.menu_id')
->where('um.user_id', '=', auth()->user()->id)
->where('is_alloted', '=', 1)
->select('m.name as menu_name', 'm.address')
->get();
@endphp

<!--start sidebar-->
<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        {{-- <div class="logo-icon">
            <img src="http://127.0.0.1:8001/build/images/logo-icon.png" class="logo-img" alt="">
        </div> --}}
        <div class="logo-name flex-grow-1">
            <h5 class="mb-0">SIMS</h5>
        </div>
        <div class="sidebar-close">
            <span class="material-icons-outlined">close</span>
        </div>
    </div>
    <div class="sidebar-nav">
        <!--navigation-->
        <ul class="metismenu" id="sidenav">
            <li>
                <a href="{{ url('/dashboard') }}" class="has-arrow {{ Request::is('dashboard*') ? 'active' : '' }}">
                    <div class="parent-icon"><i class="material-icons-outlined"></i></div>
                    <div class="menu-title">My Dashboard</div>
                </a>
            </li>

            @foreach ($user_menus as $menu)
            <li>
                <a href="{{ url($menu->address) }}" class="has-arrow {{ Request::is($menu->address) ? 'active' : '' }}">
                    <div class="parent-icon">
                        @if ($menu->menu_name == 'Customer Master')
                        <i class="fa fa-address-book" aria-hidden="true"></i>
                        @elseif ($menu->menu_name == 'Employee Details')
                        <i class="fa fa-users" aria-hidden="true"></i>
                        @elseif ($menu->menu_name == 'Service Master')
                        <i class="fa fa-cogs" aria-hidden="true"></i>
                        @elseif ($menu->menu_name == 'Reports')
                        <i class="fa fa-file-alt" aria-hidden="true"></i>
                        @elseif ($menu->menu_name == 'User Management')
                        <i class="fa fa-user" aria-hidden="true"></i>
                        @endif
                    </div>
                    <div class="menu-title">{{ $menu->menu_name }}</div>
                </a>
            </li>
            @endforeach
        </ul>
        <!--end navigation-->
    </div>
</aside>
<!--end sidebar-->
