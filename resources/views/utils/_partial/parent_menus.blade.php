<li class="nav-main-item {{ request()->routeIs($data['route']??'') ? ' open' : '' }}">
    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
       aria-expanded="true" href="#">
        <i class="nav-main-link-icon si si-bulb"></i>
        <span class="nav-main-link-name">{{$data['name']??''}}</span>
    </a>
    <ul class="nav-main-submenu">
        {!! $inner_html??'' !!}
    </ul>
</li>
